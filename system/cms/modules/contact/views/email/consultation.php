<html>
	<head>
		<meta charset="utf-8">
		<style type="text/css">
			body {
				font-family:Arial, Helvetica, sans-serif;
				font-size:10pt;
				color: #333;
				text-align: left;
			}
			
			ul,
			ul li,
			dl,
			dl dt,
			dl dd { padding: 0; margin: 0;}
			
			ul li {list-style-type: none;}
		
			
			table { width:600px; border-collapse:collapse; margin-top: 20px; margin-bottom:0.5em; font-size: 11px;text-align: left;table-layout:fixed; }
			table caption { font-variant:small-caps; }
			
			th,td { padding:0.5em; }
			thead th { color:#000; border-bottom:1px #ccc dotted; }
			tbody th { background:#e0e0e0; color:#333; }
			tbody th[scope="row"], tbody th.sub { background:#f0f0f0; }
			
			tbody th { border-bottom:1px solid #fff; text-align:left; }
			tbody td { border-bottom:1px solid #eee; padding: 0.5em 0.5em;}
			
			tbody tr:hover th[scope="row"],
			tbody tr:hover tbody th.sub { background:#f0e8e8; }
			tbody tr:hover td { background:#fff8f8; }
			
			.ldisclaimer {padding: 10px 0;margin: 20px 0; border-top: 1px #CCC solid;}
			.ldisclaimer p {font-size: 6pt;}
			.message {
				border: 1px solid #a6d877; 
				margin: 20px 0 5px 0; 
				padding: 8px 10px 0 10px; 
				text-align: left;
				background: #d2ecba;
				color: #336801;
			}
			
			.msg p {margin: 0 0 8px 0; padding-left: 25px;text-align: left; font-size: 12px;}
			
		</style>
	</head>
	<body>
		<table>
			<tbody>
				<tr>
					<td><h2>WCI Inquiry</h2></td>
				</tr>
			</tbody>
		</table>
		
		<table>
			<thead>
				<tr>
					<th width="100px">Created</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo date('m-d-Y'); ?></td>
				</tr>
			</tbody>
		</table>
		
		<table>
	
			<tbody>

				<tr>
					<td>Full Name:</td>
					<td><?php if(isset($fullname)) { echo $fullname; } ?></td>
				</tr>
				
				<tr>
					<td>First Name:</td>
					<td><?php if(isset($first_name)) { echo $first_name; } ?></td>
				</tr>
				
				<tr>
					<td>Last Name:</td>
					<td><?php if(isset($last_name)) { echo $last_name; } ?></td>
				</tr>

				<tr>
					<td>Email:</td>
					<td><?php if(isset($email)) { echo $email; }  ?></td>
				</tr>
				
				<tr>
					<td>Phone:</td>
					<td><?php if(isset($telephone)) { echo $telephone; }  ?></td>
				</tr>
				
					<td>Website:</td>
					<td><?php if(isset($website)) { echo $website; }  ?></td>
				</tr>
				
					<td>Industry:</td>
					<td><?php if(isset($industry)) { echo $industry; }  ?></td>
				</tr>

			</tbody>
		</table>

		
		<table>
			<tbody>
				<tr>
					<td>Comments:</td>
					<td><?php if(isset($comments)) { echo strip_tags($comments); }  ?></td>
				</tr>

			</tbody>
		</table>

		<?php 
			$date = date('m-d-Y');
			$md = date('m-d');
			if($md == '05-20')
			{
				$gregg = '<p>Hey, today is <strong><a href="mailto:gregg.moore23@gmail.com">Gregg\'s</a> birthday</strong>. Wish him a good one! God bless you!</p>';
			}
		?>
		<p style="margin-top: 20px;">This message was delivered on: <?php echo date('m/d/Y H:i:s'); ?></p>
		<?php if(isset($gregg)) { echo $gregg; } ?><br />
	</body>
</html>