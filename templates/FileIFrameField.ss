<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<% base_tag %>
		
		<title><% _t('TITLE', 'Image Uploading Iframe') %></title>
	</head>
	
	<body>
		<div class="mainblock editform">
			$EditFileForm
		</div>
		
		<% if AttachedFile.ID %>
			<div class="mainblock">
				$AttachedFile.CMSThumbnail
				
				<% if DeleteFileForm %>
					$DeleteFileForm
				<% end_if %>
			</div>
		<% end_if %>
	</body>
	
</html>