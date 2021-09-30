var Map = (function($, window, document, undefined) {
    'use strict';
    var ns = 'Map';
    $.fn[ns] = function(options) {
        if (typeof arguments[0] === 'string') {
            var method = arguments[0],
                args = Array.prototype.slice.call(arguments, 1),
                value;
            this.each(function() {
                var inst = $.data(this, ns);
                if (inst && typeof inst[method] === 'function') {
                    value = inst[method].apply(inst, args);
                }
            });
            return value;
        } else if (typeof options === 'object' || !options) {
            return this.each(function() {
                $.data(this, ns, new Map(this, options));
            });
        }
    };
    var Map = function(el, options) {
        this.$el = $(el);
        this.opts = $.extend(true, {
            init: true,
            onInit: null,
            tooltip: true,
            streetview: false,
            scrollwheel: false,
            restore: false,
            type: 'roadmap',
            zoom: 12,
            maxZoom: 18,
            center: {},
            polygons: [],
            radiuses: [],
            manager: {},
            polygonControl: {
                el: '#GPolygonControl',
                onRefresh: null,
                polygonOptions: {
                    fillColor: '#0055FF',
                    fillOpacity: 0.25,
                    strokeColor: '#0000FF',
                    strokeOpacity: 0.5,
                    strokeWeight: 2
                }
            },
            radiusControl: {
                el: '#GRadiusControl',
                onRefresh: null,
                circleOptions: {
                    fillColor: '#0EBE09',
                    fillOpacity: 0.25,
                    strokeColor: '#0EBE09',
                    strokeOpacity: 1,
                    strokeWeight: 2
                }
            },
            mapOptions: {}
        }, options);
        this.overlays = [];
        this.tooltip = this.opts.tooltip ? new Map.Tooltip() : null;
        if (this.opts.init) this.init();
    };
    Map.version = 3;
    Map.isLoaded = false;
    Map.isMobile = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/) ? true : false;
    Map.libraries = ['drawing', 'geometry', 'places'];
    Map.loadApi = function(callback) {
        if (Map.isLoaded === true) {
            if (typeof callback === 'function') callback();
        } else if (typeof Map.callback === 'function' && typeof callback === 'function') {
            var cb = Map.callback;
            Map.callback = function() {
                cb();
                callback();
            };
        } else {
            Map.callback = function() {
                Map.isLoaded = true;
                if (typeof callback === 'function') callback();
            };
            var script = document.createElement('script');
            script.src = '//maps.googleapis.com/maps/api/js?key=AIzaSyAwjfC8p1xuFjMSm_eMHyQ4Gu05axE5tLQ&sensor=false&v=' + Map.version +
                (Map.libraries ? '&libraries=' + Map.libraries.join(',') : '') +
                (Map.callback ? '&callback=Map.callback' : '');
            document.body.appendChild(script);
        }
    };
    Map.prototype = {
        getSelf: function() {
            return this;
        },
        getMap: function() {
            return this.gmap;
        },
        getTooltip: function() {
            return this.tooltip;
        },
        getTypeId: function(type) {
            switch (type) {
                default:
                    case 'roadmap':
                    case google.maps.MapTypeId.ROADMAP:
                    return google.maps.MapTypeId.ROADMAP;
                case 'hybrid':
                        case google.maps.MapTypeId.HYBRID:
                        return google.maps.MapTypeId.HYBRID;
                case 'terrain':
                        case google.maps.MapTypeId.TERRAIN:
                        return google.maps.MapTypeId.TERRAIN;
                case 'satellite':
                        case google.maps.MapTypeId.SATELLITE:
                        return google.maps.MapTypeId.SATELLITE;
            }
        },
        setOptions: function(opts) {
            return $.extend(true, this.opts, opts);
        },
        showLoader: function() {
            this.loader.setMap(this.gmap);
        },
        hideLoader: function() {
            this.loader.setMap(null);
        },
        setCenter: function(lat, lng) {
            this.gmap && this.gmap.setCenter(new google.maps.LatLng(lat, lng));
        },
        setZoom: function(zoom) {
            this.gmap && this.gmap.setZoom(zoom);
        },
        setType: function(type) {
            this.gmap && this.gmap.setMapTypeId(this.getTypeId(type));
        },
        getPolygons: function() {
            return this.polygonControl && this.polygonControl.serialize();
        },
        getRadiuses: function() {
            return this.radiusControl && this.radiusControl.serialize();
        },
        getBounds: function() {
            return this.gmap && this.gmap.getBounds();
        },
        getCenter: function() {
            return this.gmap && this.gmap.getCenter();
        },
        getZoom: function() {
            return this.gmap && this.gmap.getZoom();
        },
        getType: function() {
            return this.gmap && this.getTypeId(this.gmap.getMapTypeId());
        },
        init: function() {
            Map.loadApi($.proxy(function() {
                var center = null,
                    zoom = null;
                if (this.opts.restore !== false) {
                    var state = this.getState('map.state');
                    if (state) {
                        state = state.split(',');
                        if (state[0] && state[1]) {
                            center = {
                                lat: state[0],
                                lng: state[1]
                            };
                        }
                        if (state[2]) {
                            zoom = parseInt(state[2]);
                        }
                    }
                }
                center = center ? center : this.opts.center;
                zoom = zoom > 0 ? zoom : this.opts.zoom;
                var type = this.getState('map.type');
                type = type ? type : this.getTypeId(this.opts.type);
                this.gmap = new google.maps.Map(this.$el.get(0), $.extend({
                    mapTypeId: type,
                    zoom: zoom,
                    maxZoom: this.opts.maxZoom,
                    scrollwheel: this.opts.scrollwheel
                }, this.opts.mapOptions));
                this.loader = new google.maps.Polygon({
                    paths: [
                        [new google.maps.LatLng(90, -180), new google.maps.LatLng(90, 0), new google.maps.LatLng(-90, 0), new google.maps.LatLng(-90, -180)],
                        [new google.maps.LatLng(90, -180), new google.maps.LatLng(90, 0.000001), new google.maps.LatLng(-90, 0.000001), new google.maps.LatLng(-90, -180)]
                    ],
                    fillColor: '#000',
                    fillOpacity: 0.6,
                    strokeOpacity: 0,
                    strokeWeight: 0
                });
                this.polygonControl = new Map.PolygonControl($.extend({
                    controls: new google.maps.drawing.DrawingManager({
                        map: this.gmap,
                        drawingControl: false,
                        drawingControlOptions: {
                            drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                        },
                        polygonOptions: $.extend({
                            editable: true
                        }, this.opts.polygonControl.polygonOptions)
                    })
                }, this.opts.polygonControl));
                this.radiusControl = new Map.RadiusControl($.extend({
                    controls: new google.maps.drawing.DrawingManager({
                        map: this.gmap,
                        drawingControl: false,
                        drawingControlOptions: {
                            drawingModes: [google.maps.drawing.OverlayType.CIRCLE]
                        },
                        circleOptions: $.extend({
                            editable: true
                        }, this.opts.radiusControl.circleOptions)
                    })
                }, this.opts.radiusControl));
                this.setCenter(center.lat, center.lng);
                this.manager = new Map.MarkerManager($.extend({
                    map: this
                }, this.opts.manager));
                google.maps.event.addListenerOnce(this.gmap, 'idle', $.proxy(function() {
                    var path = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/'));
                    google.maps.event.addListener(this.gmap, 'idle', $.proxy(function() {
                        if (this.tooltip) this.tooltip.hide(true);
                        if (this.opts.restore !== false) {
                            var center = this.getCenter();
                            this.saveState('map.state', center.lat() + ',' + center.lng() + ',' + this.getZoom(), {
                                path: path
                            });
                        }
                    }, this));
                    google.maps.event.addListener(this.gmap, 'maptypeid_changed', $.proxy(function() {
                        this.saveState('map.type', this.gmap.getMapTypeId(), {
                            path: path
                        });
                    }, this));
                    if (this.opts.polygons) this.polygonControl.load(this.opts.polygons);
                    if (this.opts.radiuses) this.radiusControl.load(this.opts.radiuses);
                    if (typeof this.opts.onInit === 'function') this.opts.onInit.call(this);
                }, this));
            }, this));
        },
        saveState: function(key, value, options) {
            options = $.extend({}, options);
            if (value === null || value === undefined) {
                options.expires = -1;
            }
            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }
            value = String(value);
            return (document.cookie = [encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''));
        },
        getState: function(key, options) {
            options = $.extend({}, options);
            var decode = options.raw ? function(s) {
                return s;
            } : decodeURIComponent;
            var pairs = document.cookie.split('; ');
            for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
                if (decode(pair[0]) === key) return decode(pair[1] || '');
            }
            return null;
        },
        clear: function() {
            this.manager && this.manager.clear();
        },
        clearPolygons: function() {
            this.polygonControl && this.polygonControl.clear();
        },
        clearRadiuses: function() {
            this.radiusControl && this.radiusControl.clear();
        },
        plot: function() {
            this.manager && this.manager.plot();
        },
        load: function(markers) {
            this.manager && this.manager.load(markers);
        },
        isHidden: function() {
            return this.$el.hasClass('hidden') ? true : false;
        },
        show: function(callback) {
            if (this.isHidden()) {
                this.$el.hide().removeClass('hidden').slideDown($.proxy(function() {
                    if (!this.gmap) this.init();
                    if (this.gmap) google.maps.event.trigger(this.gmap, 'resize');
                    if (typeof callback === 'function') callback();
                }, this));
            } else {
                if (typeof callback === 'function') callback();
            }
        },
        hide: function(callback) {
            if (!this.isHidden()) {
                if (this.tooltip) this.tooltip.hide(true);
                this.$el.slideUp($.proxy(function() {
                    this.$el.addClass('hidden');
                    if (this.gmap) google.maps.event.trigger(this.gmap, 'resize');
                    if (typeof callback === 'function') callback();
                }, this));
            } else {
                if (typeof callback === 'function') callback();
            }
        }
    };
    return Map;
}).apply({}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.Marker = function(options) {
        var defaults = {
            map: null,
            lat: null,
            lng: null,
            icon: null,
            iconShadow: null,
            title: '',
            tooltip: false,
            visible: true,
            zIndex: 101,
            onClick: function() {
                this.showTooltip(true);
            },
            onMouseOver: function() {
                this.showTooltip();
            },
            onMouseOut: function() {
                this.hideTooltip();
            }
        };
        this.opts = $.extend({}, defaults, options);
        if (this.opts.lat && this.opts.lng) {
            this.point = new google.maps.LatLng(this.opts.lat, this.opts.lng);
        } else {
            this.point = null;
        }
        this.marker = new google.maps.Marker({
            map: this.opts.visible === true ? this.opts.map.getMap() : null,
            icon: this.opts.icon,
            shadow: this.opts.iconShadow,
            optimized: false,
            title: this.opts.title,
            position: this.point,
            zIndex: this.opts.zIndex
        });
        this.bindEvents();
    };
    this.Marker.prototype = {
        hide: function() {
            this.marker.setMap(null);
            if (this.label) this.label.setMap(null);
        },
        show: function() {
            var gmap = this.opts.map.getMap();
            this.marker.setMap(gmap);
            if (this.label) this.label.setMap(gmap);
        },
        getMarker: function() {
            return this.marker;
        },
        getPoint: function() {
            return this.point;
        },
        getTooltip: function() {
            return this.opts.tooltip;
        },
        getTitle: function() {
            return this.opts.title;
        },
        setLabel: function(text) {
            if (this.label) {
                this.label.setText(text);
            } else {
                this.label = new Map.MarkerLabel(this.getMarker(), text);
            }
        },
        setPoint: function(lat, lng) {
            this.point = new google.maps.LatLng(lat, lng);
            this.marker.setPosition(this.point);
        },
        setTooltip: function(html) {
            this.opts.tooltip = html;
        },
        setTitle: function(title) {
            this.opts.title = title;
            this.marker.setTitle(title);
        },
        setIcon: function(icon) {
            this.marker.setIcon(icon);
        },
        select: function() {
            var map = this.marker.getMap();
            if (!map.getBounds().contains(this.point)) {
                map.panTo(this.point);
                google.maps.event.addListenerOnce(map, 'idle', $.proxy(function() {
                    this.showTooltip(true);
                }, this));
            } else {
                this.showTooltip(true);
            }
        },
        showTooltip: function(sticky) {
            var offset = this.getOffset(),
                tooltip = this.opts.map.getTooltip();
            if (offset && tooltip && this.opts.tooltip && (sticky || !tooltip.getSticky())) {
                tooltip.setHtml(this.opts.tooltip);
                tooltip.setPosition(offset);
                tooltip.show(sticky);
            }
        },
        hideTooltip: function() {
            var tooltip = this.opts.map.getTooltip();
            if (tooltip) tooltip.hide();
        },
        getOffset: function() {
            var gmap = this.marker.getMap();
            if (!gmap) return null;
            var scale = Math.pow(2, gmap.getZoom()),
                nw = new google.maps.LatLng(gmap.getBounds().getNorthEast().lat(), gmap.getBounds().getSouthWest().lng()),
                wnw = gmap.getProjection().fromLatLngToPoint(nw),
                w = gmap.getProjection().fromLatLngToPoint(this.marker.getPosition());
            return {
                x: $(gmap.getDiv()).offset().left + Math.floor((w.x - wnw.x) * scale),
                y: $(gmap.getDiv()).offset().top + Math.floor((w.y - wnw.y) * scale)
            };
        },
        bindEvents: function() {
            if (typeof this.opts.onClick === 'function') {
                google.maps.event.addListener(this.marker, 'click', $.proxy(this.opts.onClick, this));
            }
            if (!Map.mobile && typeof this.opts.onMouseOver === 'function') {
                google.maps.event.addListener(this.marker, 'mouseover', $.proxy(this.opts.onMouseOver, this));
            }
            if (!Map.mobile && typeof this.opts.onMouseOut === 'function') {
                google.maps.event.addListener(this.marker, 'mouseout', $.proxy(this.opts.onMouseOut, this));
            }
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.Tooltip = function(options) {
        this.opts = $.extend({
            delay: 500,
            sticky: false,
            closeBtn: 'a.action-close'
        }, options);
        this.$el = $('<div>').css({
            border: 'none',
            position: 'absolute',
            paddingLeft: '0',
            zIndex: '9000'
        }).on('click', this.opts.closeBtn, $.proxy(function() {
            this.hide(true);
        }, this));
        this.bindEvents();
    };
    this.Tooltip.prototype = {
        getSticky: function() {
            return this.opts.sticky;
        },
        getHtml: function() {
            return this.$el.html();
        },
        setSticky: function(sticky) {
            if (sticky) {
                this.opts.sticky = true;
                this.$el.find(this.opts.closeBtn).removeClass('hidden');
            } else {
                this.opts.sticky = false;
                this.$el.find(this.opts.closeBtn).addClass('hidden');
            }
        },
        setHtml: function(html) {
            this.$el.html(html);
        },
        setDelay: function(delay) {
            this.opts.delay = delay;
        },
        setPosition: function(pos) {
            this.$el.css({
                left: pos.x + 'px',
                top: pos.y + 'px'
            });
        },
        show: function(sticky) {
            if (this.timeout) clearTimeout(this.timeout);
            if (sticky) this.setSticky(true);
            this.timeout = setTimeout($.proxy(function() {
                this.$el.appendTo('body');
            }, this), this.opts.delay);
        },
        hide: function(force) {
            if (force) {
                this.setSticky(false);
                this.$el.detach();
            } else if (!this.opts.sticky && !this.over) {
                if (this.timeout) clearTimeout(this.timeout);
                this.timeout = setTimeout($.proxy(function() {
                    if (!this.opts.sticky && !this.over) this.$el.detach();
                }, this), this.opts.delay);
            }
        },
        bindEvents: function() {
            this.$el.on('mouseenter', $.proxy(function() {
                this.over = true;
            }, this));
            this.$el.on('mouseleave', $.proxy(function() {
                this.over = false;
                this.hide();
            }, this));
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.Directions = function(options) {
        this.opts = $.extend(true, {
            el: null,
            to: null,
            from: null,
            unit: 'imperial',
            renderer: {
                draggable: true,
                map: null,
                panel: null
            },
            onSuccess: null,
            onFailure: null
        }, options);
        if (!Map.isLoaded) {
            Map.loadApi($.proxy(function() {
                this.init();
            }, this));
        } else {
            this.init();
        }
    };
    this.Directions.prototype = {
        init: function() {
            this.directions = new google.maps.DirectionsService();
            this.renderer = new google.maps.DirectionsRenderer(this.opts.renderer);
            if (this.opts.from && this.opts.to) {
                this.getDirections(this.opts.from, this.opts.to);
            }
        },
        getDirections: function(from, to) {
            if (!from || !to) return;
            this.directions.route({
                origin: from,
                destination: to,
                unitSystem: this.getUnitId(this.opts.unit),
                travelMode: google.maps.TravelMode.DRIVING
            }, $.proxy(function(result, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    if (typeof this.opts.onSuccess === 'function') this.opts.onSuccess.call(this, result);
                    this.renderer.setDirections(result);
                } else {
                    if (typeof this.opts.onFailure === 'function') this.opts.onFailure.call(this, this.getErrorMsg(status));
                }
            }, this));
        },
        getErrorMsg: function(error) {
            switch (error) {
                case 'NOT_FOUND':
                case google.maps.DirectionsStatus.NOT_FOUND:
                    return 'An error occurred. Your origin or destination could not be found.';
                case 'ZERO_RESULTS':
                case google.maps.DirectionsStatus.ZERO_RESULTS:
                    return 'Directions could not be found between your origin and destination.';
                case 'REQUEST_DENIED':
                case google.maps.DirectionsStatus.REQUEST_DENIED:
                    return 'An error has occurred. Your request was denied.';
                case 'OVER_QUERY_LIMIT':
                case google.maps.DirectionsStatus.OVER_QUERY_LIMIT:
                    return 'Your request could not be processed right now. Please try again later.';
                case 'UNKNOWN_ERROR':
                case google.maps.DirectionsStatus.UNKNOWN_ERROR:
                    return 'An error occurred while processing your request. Please try again.';
                case 'INVALID_REQUEST':
                case google.maps.DirectionsStatus.INVALID_REQUEST:
                    return 'An error occurred while processing your request';
            }
        },
        getUnitId: function(unit) {
            switch (unit) {
                case 'imperial':
                case google.maps.UnitSystem.IMPERIAL:
                    return google.maps.UnitSystem.IMPERIAL;
                case 'metric':
                case google.maps.UnitSystem.METRIC:
                    return google.maps.UnitSystem.METRIC;
            }
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.Streetview = function(options) {
        this.opts = $.extend({
            el: null,
            lat: null,
            lng: null,
            onSuccess: null,
            onFailure: null
        }, options);
        if (!Map.isLoaded) {
            Map.loadApi($.proxy(function() {
                this.init();
            }, this));
        } else {
            this.init();
        }
    };
    this.Streetview.prototype = {
        init: function() {
            this.setPoint(this.opts.lat, this.opts.lng);
            var streetview = new google.maps.StreetViewService();
            streetview.getPanoramaByLocation(this.getPoint(), 100, $.proxy(function(data, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var latlng = data.location.latLng;
                    this.loadPanorama(latlng.lat(), latlng.lng());
                    if (typeof this.opts.onSuccess === 'function') this.opts.onSuccess.call(this, data);
                } else {
                    if (typeof this.opts.onFailure === 'function') this.opts.onFailure.call(this);
                }
            }, this));
        },
        setPoint: function(lat, lng) {
            this.point = new google.maps.LatLng(lat, lng);
        },
        getPoint: function() {
            return this.point;
        },
        loadPanorama: function(lat, lng) {
            if (!this.opts.el || !lat || !lng) return;
            var center = new google.maps.LatLng(lat, lng);
            var heading = google.maps.geometry.spherical.computeHeading(center, this.getPoint());
            new google.maps.StreetViewPanorama(this.opts.el, {
                disableDefaultUI: true,
                streetViewControl: false,
                pov: {
                    heading: heading,
                    pitch: -10,
                    zoom: 10
                }
            });
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.SearchControl = function(options) {
        this.opts = $.extend({
            el: null,
            onDraw: null,
            onDelete: null,
            onRefresh: null,
            controls: null,
            multiples: false,
            drawText: 'Draw New',
            doneText: 'Done Drawing',
            editText: 'Edit',
            deleteText: '&times;',
            helpText: 'Click on the map to continue drawing.'
        }, options);
        this.MODE_DRAW = 'draw';
        this.MODE_IDLE = 'idle';
        this.mode = this.MODE_IDLE;
        this.controls = this.opts.controls ? this.opts.controls : null;
        this.searches = [];
        this.listener = null;
        var $el = this.opts.el ? $(this.opts.el) : false;
        if ($el.length > 0) {
            this.$draw = $('<a href="javascript:void(0);"><span class="ico"></span> <span class="text">' + this.opts.drawText + '</span></a>').appendTo($el);
            this.$tooltip = $('<small class="tip hidden">' + this.opts.helpText + '</small>').appendTo($el);
            this.$list = $('<ul class="hidden">').appendTo($el);
            this.bindEvents();
        }
    };
    this.SearchControl.prototype = {
        getSearches: function() {
            return this.searches;
        },
        hasSearches: function() {
            return this.searches.length > 0 ? true : false;
        },
        enable: function() {
            this.mode = this.MODE_DRAW;
            if (this.$draw) this.$draw.find('.text').text(this.opts.doneText);
            if (this.$tooltip) this.$tooltip.removeClass('hidden');
            this.draw();
            this.refresh();
        },
        disable: function() {
            this.mode = this.MODE_IDLE;
            this.controls.setDrawingMode(null);
            if (this.$draw) this.$draw.find('.text').text(this.opts.drawText);
            if (this.$tooltip) this.$tooltip.addClass('hidden');
            google.maps.event.removeListener(this.listener);
            this.refresh();
        },
        clear: function() {
            var l = this.searches.length;
            if (l > 0) {
                var i = 0;
                for (i; i < l; i++) {
                    this.searches[i].setMap(null);
                }
            }
            this.searches = [];
            this.refresh();
        },
        refresh: function() {
            var l = this.searches.length;
            if (this.$list) {
                if (l > 0) {
                    if (this.opts.multiples !== true) {
                        this.$draw.addClass('hidden');
                    }
                    var i = 0,
                        html = '';
                    for (i; i < l; i++) {
                        var search = this.searches[i];
                        search.setEditable(false);
                        html += '<li data-id="' + i + '"><span class="ico"></span> ' +
                            '<a href="javascript:void(0);" class="edit" data-id=' + i + '>' + this.opts.editText + '</a> ' +
                            '<a href="javascript:void(0);" class="delete" data-id=' + i + '>' + this.opts.deleteText + '</a></li>';
                    }
                    this.$list.html(html).removeClass('hidden');
                } else {
                    this.$draw.removeClass('hidden');
                    this.$list.addClass('hidden').html('');
                }
            }
            if (typeof this.opts.onRefresh === 'function') this.opts.onRefresh.call(this);
        },
        bindEvents: function() {
            this.$draw.on('click', $.proxy(function() {
                if (this.mode === this.MODE_IDLE) {
                    this.enable();
                } else {
                    this.disable();
                }
            }, this));
            this.$list.on('click', 'a.edit', $.proxy(function(event) {
                var $link = $(event.target),
                    id = $link.data('id'),
                    search = this.searches[id],
                    editable = search.getEditable();
                this.disable();
                $link = this.$list.find('a.edit[data-id="' + id + '"]');
                if (editable) {
                    search.setEditable(false);
                    $link.text(this.opts.editText);
                } else {
                    search.setEditable(true);
                    $link.text('Done');
                }
            }, this));
            this.$list.on('click', 'a.delete', $.proxy(function(event) {
                var $link = $(event.target),
                    id = $link.data('id'),
                    search = this.searches[id];
                if (search) {
                    search.setMap(null);
                    this.searches.splice(id, 1);
                    this.refresh();
                    if (typeof this.opts.onDelete === 'function') this.opts.onDelete.call(this, search);
                }
            }, this));
            this.$list.on({
                mouseenter: $.proxy(function(event) {
                    var $link = $(event.target),
                        id = $link.data('id'),
                        search = this.searches[id];
                    if (search) search.setOptions({
                        fillOpacity: 0.50
                    });
                }, this),
                mouseleave: $.proxy(function(event) {
                    var $link = $(event.target),
                        id = $link.data('id'),
                        search = this.searches[id];
                    if (search) search.setOptions({
                        fillOpacity: 0.25
                    });
                }, this)
            }, 'li');
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.RadiusControl = function(options) {
        this.opts = $.extend({
            drawText: 'Draw Radius',
            editText: 'Edit Radius',
            helpText: 'Click on the map to draw your radius search.'
        }, options);
        Map.SearchControl.call(this, this.opts);
    };
    this.RadiusControl.prototype = $.extend({}, this.SearchControl.prototype, {
        computeSize: function(search) {
            return search.getRadius();
        },
        serialize: function() {
            var radiuses = this.getSearches(),
                json = [];
            if (radiuses && radiuses.length > 0) {
                var l = radiuses.length,
                    i = 0;
                for (i; i < l; i++) {
                    var radius = radiuses[i],
                        c = radius.getCenter();
                    json.push(c.lat() + ',' + c.lng() + ',' + parseFloat(radius.getRadius() / 1609));
                }
            }
            return json.length > 0 ? '["' + json.join('", "') + '"]' : null;
        },
        draw: function() {
            this.controls.setDrawingMode(google.maps.drawing.OverlayType.CIRCLE);
            this.listener = google.maps.event.addListenerOnce(this.controls, 'circlecomplete', $.proxy(function(radius) {
                radius.setEditable(false);
                this.searches.push(radius);
                this.disable();
                if (typeof this.opts.onDraw === 'function') this.opts.onDraw.call(this, radius);
            }, this));
        },
        load: function(radiuses) {
            var i = radiuses.length - 1;
            for (i; i >= 0; i--) {
                var r = radiuses[i];
                var radius = new google.maps.Circle($.extend({}, this.controls.get('circleOptions'), {
                    map: this.controls.getMap(),
                    radius: (r.radius * 1609),
                    center: new google.maps.LatLng(r.lat, r.lng),
                    editable: r.edit ? true : false
                }));
                this.searches.push(radius);
                if (typeof this.opts.onDraw === 'function') this.opts.onDraw.call(this, radius);
            }
            this.refresh();
        }
    });
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.PolygonControl = function(options) {
        this.opts = $.extend({
            drawText: 'Draw Polygon',
            editText: 'Edit Polygon',
            helpText: 'Click on the map to draw your polygon search.'
        }, options);
        Map.SearchControl.call(this, this.opts);
    };
    this.PolygonControl.prototype = $.extend({}, this.SearchControl.prototype, {
        computeSize: function(search) {
            return google.maps.geometry.spherical.computeArea(search.getPath());
        },
        serialize: function() {
            var polygons = this.getSearches(),
                json = [];
            if (polygons && polygons.length > 0) {
                var len = polygons.length,
                    i = 0;
                for (i; i < len; i++) {
                    var polygon = polygons[i],
                        points = polygon.getPath().getArray(),
                        l = points.length,
                        p = 0,
                        wkt = [];
                    for (p; p < l; p++) {
                        var point = points[p];
                        if (point) wkt.push(point.lat() + ' ' + point.lng());
                    }
                    var l = wkt.length;
                    if (l > 0) {
                        if (wkt[0] !== wkt[l - 1]) {
                            wkt.push(wkt[0]);
                        }
                        json.push(wkt.join(','));
                    }
                }
            }
            return json.length > 0 ? '["' + json.join('", "') + '"]' : null;
        },
        draw: function() {
            this.controls.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
            this.listener = google.maps.event.addListenerOnce(this.controls, 'polygoncomplete', $.proxy(function(polygon) {
                var path = polygon.getPath().getArray(),
                    f = path[0];
                if (path.length > 2) {
                    path.push(f);
                    polygon.setEditable(false);
                    this.searches.push(polygon);
                } else {
                    polygon.setMap(null);
                }
                this.disable();
                if (typeof this.opts.onDraw === 'function') this.opts.onDraw.call(this, polygon);
            }, this));
        },
        load: function(polygons) {
            var i = polygons.length - 1;
            for (i; i >= 0; i--) {
                var poly = polygons[i],
                    paths = [],
                    v = poly.length - 1;
                for (v; v >= 0; v--) {
                    var path = poly[v];
                    paths.push(new google.maps.LatLng(path.lat, path.lng));
                }
                var polygon = new google.maps.Polygon($.extend({}, this.controls.get('polygonOptions'), {
                    map: this.controls.getMap(),
                    paths: paths,
                    editable: false
                }));
                this.searches.push(polygon);
                if (typeof this.opts.onDraw === 'function') this.opts.onDraw.call(this, polygon);
            }
            this.refresh();
        }
    });
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.MarkerManager = function(options) {
        $.extend(true, Map.MarkerManager.prototype, google.maps.OverlayView.prototype);
        var defaults = {
            map: null,
            bounds: true,
            cluster: false,
            markers: [],
            stack: true,
            icon: '/img/map/marker-home@2x.png',
            iconWidth: 22,
            iconHeight: 25,
            iconCluster: '/img/map/cluster-home@2x.png',
            iconClusterWidth: 31,
            iconClusterHeight: 25,
            iconStacked: '/img/map/stacked-home@2x.png',
            iconStackedWidth: 20,
            iconStackedHeight: 23,
            iconShadow: '/img/map/shadow@2x.png',
            iconShadowWidth: 14,
            iconShadowHeight: 6,
            iconShadowAnchorX: 7,
            iconShadowAnchorY: 3,
            maxZoom: 14,
            gridSize: 60,
            minClusterSize: 3,
            averageCenter: false,
            titleStacked: '{x} Properties Found at This Location.',
            titleCluster: '{x} Properties Found.'
        };
        this.opts = $.extend({}, defaults, options);
        this.icon = new google.maps.MarkerImage(this.opts.icon, null, null, null, new google.maps.Size(this.opts.iconWidth, this.opts.iconHeight));
        this.iconShadow = new google.maps.MarkerImage(this.opts.iconShadow, null, null, new google.maps.Point(this.opts.iconShadowAnchorX, this.opts.iconShadowAnchorY), new google.maps.Size(this.opts.iconShadowWidth, this.opts.iconShadowHeight));
        this.iconCluster = new google.maps.MarkerImage(this.opts.iconCluster, null, null, null, new google.maps.Size(this.opts.iconClusterWidth, this.opts.iconClusterHeight));
        this.iconStacked = new google.maps.MarkerImage(this.opts.iconStacked, null, null, null, new google.maps.Size(this.opts.iconStackedWidth, this.opts.iconStackedHeight));
        this.markers = [];
        this.clusters = [];
        this.zIndex = 101;
        var gmap = this.opts.map.getMap();
        this.setMap(gmap);
    };
    this.MarkerManager.prototype = {
        draw: function() {},
        onAdd: function() {
            if (this.opts.markers) this.load(this.opts.markers);
            var manager = this;
            this.listeners = [google.maps.event.addListener(this.getMap(), 'zoom_changed', function() {
                manager.removeClusters(true);
                if (this.getZoom() === 0) {
                    google.maps.event.trigger(this, 'idle');
                }
            }), google.maps.event.addListenerOnce(this.getMap(), 'idle', function() {
                var $map = $(this.getDiv());
                $map.height($map.height() + 1);
                google.maps.event.trigger(this, 'resize');
            }), google.maps.event.addListener(this.getMap(), 'idle', function() {
                manager.plot();
            })];
        },
        onRemove: function() {
            this.removeClusters(false);
            if (this.listeners.length > 0) {
                var listener = null;
                while (listener = this.listeners.pop()) {
                    google.maps.event.removeListener(listener);
                }
            }
            this.listeners = [];
        },
        clear: function() {
            this.removeMarkers();
            this.removeClusters();
        },
        removeMarkers: function() {
            if (this.markers.length > 0) {
                var marker = null;
                while (marker = this.markers.pop()) {
                    marker.hide();
                }
            }
            this.markers = [];
        },
        removeClusters: function(hide) {
            if (this.clusters.length > 0) {
                var cluster = null;
                while (cluster = this.clusters.pop()) {
                    cluster.remove();
                }
            }
            this.clusters = [];
            var i = 0,
                l = this.markers.length,
                marker;
            for (i; i < l; i++) {
                marker = this.markers[i];
                marker.isAdded = false;
                if (hide) {
                    marker.hide();
                }
            }
        },
        getMarkers: function() {
            return this.markers;
        },
        getMaxZoom: function() {
            return this.opts.maxZoom;
        },
        getMinClusterSize: function() {
            return this.opts.minClusterSize;
        },
        getAvgCenter: function() {
            return this.opts.averageCenter;
        },
        load: function(markers) {
            this.removeMarkers(true);
            var bounds = new google.maps.LatLngBounds();
            var data = null;
            while (data = markers.pop()) {
                if (data.icon) {
                    data.iconWidth = data.iconWidth > 0 ? data.iconWidth : this.opts.iconWidth;
                    data.iconHeight = data.iconHeight > 0 ? data.iconHeight : this.opts.iconHeight;
                    data.icon = new google.maps.MarkerImage(data.icon, null, null, null, new google.maps.Size(data.iconWidth, data.iconHeight));
                }
                var marker = new Map.Marker($.extend({
                    map: this.opts.map,
                    icon: this.icon,
                    iconShadow: this.iconShadow,
                    visible: false,
                    zIndex: this.zIndex++
                }, data));
                this.markers.push(marker);
                bounds.extend(marker.getPoint());
            }
            if (this.opts.bounds && !bounds.isEmpty()) {
                this.getMap().fitBounds(bounds);
            }
            this.plot();
        },
        plot: function() {
            var gmap = this.getMap();
            if (gmap.getZoom() > 3) {
                var bounds = gmap.getBounds();
                bounds = new google.maps.LatLngBounds(bounds.getSouthWest(), bounds.getNorthEast());
            } else {
                var bounds = new google.maps.LatLngBounds(new google.maps.LatLng(85.02070771743472, -178.48388434375), new google.maps.LatLng(-85.08136444384544, 178.00048865625));
            }
            bounds = this.extendBounds(bounds);
            var i = 0,
                l = this.markers.length,
                marker;
            for (i; i < l; i++) {
                marker = this.markers[i];
                if (!marker.isAdded && bounds.contains(marker.getPoint())) {
                    this._addToClosestCluster(marker);
                }
            }
        },
        extendBounds: function(bounds) {
            var projection = this.getProjection();
            var tr = new google.maps.LatLng(bounds.getNorthEast().lat(), bounds.getNorthEast().lng());
            var bl = new google.maps.LatLng(bounds.getSouthWest().lat(), bounds.getSouthWest().lng());
            var trPix = projection.fromLatLngToDivPixel(tr);
            trPix.x += this.opts.gridSize;
            trPix.y -= this.opts.gridSize;
            var blPix = projection.fromLatLngToDivPixel(bl);
            blPix.x -= this.opts.gridSize;
            blPix.y += this.opts.gridSize;
            var ne = projection.fromDivPixelToLatLng(trPix);
            var sw = projection.fromDivPixelToLatLng(blPix);
            bounds.extend(ne);
            bounds.extend(sw);
            return bounds;
        },
        _distanceBetweenPoints: function(p1, p2) {
            var R = 6371;
            var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
            var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return (R * c);
        },
        _addToClosestCluster: function(marker) {
            var i, d, cluster, center, clusterToAddTo = null;
            var distance = 40000;
            for (i = 0; i < this.clusters.length; i++) {
                cluster = this.clusters[i];
                center = cluster.getCenter();
                if (center) {
                    d = this._distanceBetweenPoints(center, marker.getPoint());
                    if (d === 0 && this.opts.stack !== false) {
                        cluster.setStacked(true);
                        cluster.addMarker(marker);
                        return;
                    }
                    if (cluster.stacked !== true && d < distance) {
                        distance = d;
                        clusterToAddTo = cluster;
                    }
                }
            }
            if (this.opts.cluster === true && clusterToAddTo && clusterToAddTo.isMarkerInClusterBounds(marker)) {
                clusterToAddTo.addMarker(marker);
            } else {
                cluster = new Map.MarkerCluster(this);
                cluster.addMarker(marker);
                this.clusters.push(cluster);
            }
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.MarkerCluster = function(manager) {
        this.manager = manager;
        this.markers = [];
        this.center = null;
        this.bounds = null;
        this.stacked = false;
        this.titleStacked = manager.opts.titleStacked;
        this.titleCluster = manager.opts.titleCluster;
        this.minClusterSize = manager.getMinClusterSize();
        this.averageCenter = manager.getAvgCenter();
        this.marker = new Map.Marker({
            map: manager.opts.map,
            icon: manager.icon,
            iconShadow: manager.iconShadow,
            visible: false,
            zIndex: manager.zIndex++,
            onClick: $.proxy(this.onClick, this)
        });
    };
    this.MarkerCluster.prototype = {
        getMarkers: function() {
            return this.markers;
        },
        getCenter: function() {
            return this.center;
        },
        setStacked: function(stacked) {
            if (this.stacked !== stacked && stacked === true) {
                var i = 0,
                    l = this.markers.length;
                for (i; i < l; i++) {
                    this.markers[i].hide();
                }
            }
            this.stacked = stacked;
        },
        pointExists: function(point) {
            var i, markers = this.markers;
            for (i = 0; i < markers.length; i++) {
                if (point.toString() === markers[i].getPoint().toString()) {
                    return true;
                }
            }
        },
        getBounds: function() {
            var i, bounds = new google.maps.LatLngBounds(this.center, this.center),
                markers = this.getMarkers();
            for (i = 0; i < markers.length; i++) {
                bounds.extend(markers[i].getPoint());
            }
            return bounds;
        },
        remove: function() {
            this.marker.hide();
            this.markers = [];
            delete this.markers;
        },
        isMarkerInClusterBounds: function(marker) {
            return this.bounds.contains(marker.getPoint());
        },
        addMarker: function(marker) {
            var i, mCount;
            if (this._isMarkerAlreadyAdded(marker)) {
                return false;
            }
            var point = marker.getPoint();
            if (!this.center) {
                this.center = point;
                this._calculateBounds();
            } else {
                if (this.averageCenter) {
                    var l = this.markers.length + 1;
                    var lat = (this.center.lat() * (l - 1) + point.lat()) / l;
                    var lng = (this.center.lng() * (l - 1) + point.lng()) / l;
                    this.center = new google.maps.LatLng(lat, lng);
                    this._calculateBounds();
                }
            }
            marker.isAdded = true;
            this.markers.push(marker);
            mCount = this.markers.length;
            var mz = this.manager.getMaxZoom();
            if (this.stacked !== true && mz !== null && this.manager.getMap().getZoom() > mz) {
                marker.show();
            } else if (this.stacked !== true && mCount < this.minClusterSize) {
                marker.show();
            } else if (mCount === this.minClusterSize) {
                for (i = 0; i < mCount; i++) {
                    this.markers[i].hide();
                }
            } else {
                marker.hide();
            }
            this.render();
            return true;
        },
        render: function() {
            var mCount = this.markers.length,
                showStacked = false;
            var mz = this.manager.getMaxZoom();
            if (mz !== null && this.manager.getMap().getZoom() > mz) {
                showStacked = true;
                if (this.stacked !== true) {
                    this.marker.hide();
                    return;
                }
            }
            if (mCount < this.minClusterSize) {
                showStacked = true;
                if (this.stacked !== true) {
                    this.marker.hide();
                    return;
                }
            }
            this.marker.setPoint(this.center.lat(), this.center.lng());
            if (mCount === 1) {
                var m = this.markers[0];
                this.marker.setTooltip(m.getTooltip());
                this.marker.setTitle(m.getTitle());
                this.marker.setIcon(this.manager.icon);
            } else if (this.stacked === true && showStacked === true) {
                var i = 0,
                    l = this.markers.length,
                    html = [];
                for (i; i < l; i++) {
                    html.push(this.markers[i].getTooltip());
                }
                this.marker.setTooltip('<div class="popover stacked">\
      <header class="title">\
       <strong>' + this.titleStacked.replace('{x}', mCount) + '</strong>\
       <a href="javascript:void(0);" class="action-close hidden">&times;</a>\
      </header>\
      <div class="body">' + html.join("\n") + '</div>\
      <div class="tail"></div>\
     </div>');
                this.marker.setIcon(this.manager.iconStacked);
            } else {
                this.marker.setTooltip('<div class="popover">\
     <header class="title">\
      <strong>' + this.titleCluster.replace('{x}', mCount) + '</strong>\
      <small>Click to Zoom In.</small>\
      <a href="javascript:void(0);" class="action-close hidden">&times;</a>\
     </header>\
     <div class="tail"></div>\
    </div>');
                this.marker.setIcon(this.manager.iconCluster);
                this.marker.setLabel(mCount);
            }
            this.marker.show();
        },
        onClick: function() {
            var bounds = this.getBounds();
            var mz = this.manager.getMaxZoom(),
                gmap = this.manager.getMap();
            if (mz === null || gmap.getZoom() <= mz) {
                gmap.fitBounds(bounds);
                if (mz !== null && gmap.getZoom() > mz) {
                    gmap.setZoom(mz + 1);
                }
            }
            this.marker.showTooltip(true);
        },
        _calculateBounds: function() {
            var bounds = new google.maps.LatLngBounds(this.center, this.center);
            this.bounds = this.manager.extendBounds(bounds);
        },
        _isMarkerAlreadyAdded: function(marker) {
            var i;
            if (this.markers.indexOf) {
                return this.markers.indexOf(marker) !== -1;
            } else {
                for (i = 0; i < this.markers.length; i++) {
                    if (marker === this.markers[i]) {
                        return true;
                    }
                }
            }
            return false;
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.MarkerLabel = function(marker, text) {
        this.marker = marker;
        this.text = text;
        var label = this.label = document.createElement('span');
        label.style.cssText = 'position: absolute; display: block; width: 30px; text-align: center; left: -15px; top: -20px; white-space: nowrap; color: #fff; font: bold 11px/11px arial;';
        var div = this.div = document.createElement('div');
        div.style.cssText = 'position: absolute; display: none';
        div.appendChild(label);
        google.maps.OverlayView.call(this);
        Map.MarkerLabel.prototype = $.extend(true, Map.MarkerLabel.prototype, google.maps.OverlayView.prototype);
        this.setMap(this.marker.getMap());
    };
    this.MarkerLabel.prototype = {
        getPosition: function() {
            return this.marker.getPosition();
        },
        setText: function(text) {
            this.label.innerHTML = this.text = text.toString();
        },
        draw: function() {
            var div = this.div,
                projection = this.getProjection(),
                position = projection.fromLatLngToDivPixel(this.getPosition());
            div.style.left = position.x + 'px';
            div.style.top = position.y + 'px';
            div.style.display = 'block';
            this.label.innerHTML = this.text.toString();
        },
        onAdd: function() {
            var pane = this.getPanes().overlayImage;
            pane.appendChild(this.div);
            this.div.style.zIndex = this.marker.getZIndex() + 1;
            var self = this;
            this.listeners = [google.maps.event.addListener(this.marker, 'position_changed', function() {
                self.draw();
            })];
        },
        onRemove: function() {
            if (this.div) {
                this.div.parentNode.removeChild(this.div);
            }
            if (this.listeners) {
                var i, l;
                for (i = 0, l = this.listeners.length; i < l; ++i) {
                    google.maps.event.removeListener(this.listeners[i]);
                }
            }
        }
    };
}).apply(Map || {}, [jQuery, window, document]);;
(function($, window, document, undefined) {
    'use strict';
    this.Birdseye = function(options) {
        this.opts = $.extend({
            el: null,
            lat: null,
            lng: null,
            zoom: 14,
            icon: '<img src="/img/map/marker-home@2x.png" width="22" height="25" alt="">'
        }, options);
        if (!Map.Birdseye.isLoaded) {
            Map.Birdseye.loadApi($.proxy(function() {
                this.init();
            }, this));
        } else {
            this.init();
        }
    };
    this.Birdseye.version = 6.3;
    this.Birdseye.isLoaded = false;
    this.Birdseye.loadApi = function(callback) {
        if (Map.Birdseye.isLoaded === true) {
            if (typeof callback === 'function') callback();
        } else if (typeof Map.Birdseye.callback === 'function' && typeof callback === 'function') {
            var cb = Map.Birdseye.callback;
            Map.Birdseye.callback = function() {
                cb();
                callback();
            };
        } else {
            Map.Birdseye.callback = function() {
                Map.Birdseye.isLoaded = true;
                if (typeof callback === 'function') callback();
            };
            $.ajax({
                url: 'https://ecn.dev.virtualearth.net/mapcontrol/v6.3/js/atlascompat.js',
                dataType: 'script',
                data: true,
                success: function() {
                    var script = document.createElement('script');
                    script.src = '//dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=' + Map.Birdseye.version + (Map.Birdseye.callback ? '&onScriptLoad=Map.Birdseye.callback&s=1' : '');
                    document.body.appendChild(script);
                }
            });
        }
    };
    this.Birdseye.prototype = {
        init: function() {
            if (!this.opts.el || !this.opts.lat || !this.opts.lng) return;
            this.setPoint(this.opts.lat, this.opts.lng);
            var vemap = this.vemap = new VEMap(this.opts.el.id);
            vemap.LoadMap(this.getPoint(), this.opts.zoom);
            if (this.opts.marker !== false) this.addMarker(this.getPoint(), this.opts.icon);
            vemap.AttachEvent('onobliqueenter', function() {
                if (vemap.IsBirdseyeAvailable()) {
                    vemap.SetMapStyle(VEMapStyle.BirdseyeHybrid);
                }
            });
            $(window).unload(function() {
                if (typeof vemap === 'VEMap') vemap.Dispose();
            });
        },
        setPoint: function(lat, lng) {
            this.point = new VELatLong(lat, lng);
        },
        addMarker: function(point, icon) {
            var marker = new VEShape(VEShapeType.Pushpin, point);
            marker.SetCustomIcon(icon);
            this.vemap.AddShape(marker);
        },
        getPoint: function() {
            return this.point;
        }
    };
}).apply(Map || {}, [jQuery, window, document]);