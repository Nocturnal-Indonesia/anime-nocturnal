<?php

$l->load->view('static/header', array(
	'assets'=>array(
			'css'	=> array('profile'),
			'js'	=> array('profile','photo_uploader')
		),
	'u'=>$u,
	'title'=>$u['nama']
	)
);
?>
<center>
<div class="prf">
	<img src="<?php print !empty($u['photo']) ? $u['photo'] : '';?>">
	<form id="myForm" action="<?php print htmlspecialchars(base_url().'/upload/photo?ref=profile&wg='.rstr(32)."&td=".md5(rstr(5)),ENT_QUOTES,'UTF-8'); ?>" method="get">
	<input type="file" name="photo" accept="image/*" onchange="__preview(this,'preview')" />
	<input type="submit" value="Upload" /><br/>
	<img id="preview" src="" alt="" width="320px"/>
</form>
</div>
</center>
</body>
</html>