<!DOCTYPE html>
<html lang="$Locale.RFC1766">
	<head>
	<% base_tag %>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>$Title</title>
</head>
<body class="loading cms" data-frameworkpath="$ModulePath(silverstripe/framework)"
	data-member-tempid="$CurrentMember.TempIDHash.ATT"
>

	<div id="emt-invert" style="
		height: 100%;
		width: 100%;
		position: fixed;
		top: 0;
		left: 0;
		z-index: 1000000;
		opacity: 85%;
		background-color: white;
		mix-blend-mode: difference;
		pointer-events: none;
	"></div>

	<% include SilverStripe\\Admin\\CMSLoadingScreen %>

	<% if $CmsHasSkipLink %>
		<%-- match 6.2 template --%>
		<a class="cms-container-skip-link flexbox-area-grow fill-height fill-width"
		href="#cms-container-skip-link-target"
		tabindex="0"
		><%t SilverStripe\\Admin\\LeftAndMain.SkipLink "Skip main navigation" %></a>

		<div class="cms-container" data-layout-type="custom">
			$Menu
			<main id="cms-container-skip-link-target"
				class="cms-container-skip-link-target"
				tabindex="-1"
			>$Content</main>
			$PreviewPanel
		</div>
	<% else %>
		<%-- match pre 6.2 template --%>
		<div class="cms-container" data-layout-type="custom">
			$Menu
			$Content
			$PreviewPanel
		</div>
	<% end_if %>
</body>
</html>
