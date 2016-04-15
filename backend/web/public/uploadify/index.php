<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<!-- <link rel="stylesheet" type="text/css" href="html5uploader.css"> -->

<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
.uploadify-button {
        background-color: transparent;
        border: none;
        padding: 0;
    }
    .uploadify:hover .uploadify-button {
        background-color: transparent;
    }
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<hr />
	
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">

		<!-- uploadify('upload','*') * 匹配所有队列文件 第二个参数匹配动态生成的queueID-->
		<!-- <a href="javascript:$('#file_upload').uploadify('upload','SWFUpload_0_0')">Upload Files</a> -->
		<a href="javascript:$('#file_upload').uploadify('upload','*')">Upload Files2</a>
	</form>
<div id="some_file_queue" style="width:auto;height:auto;"></div>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			// 以下所有均在 官方 doc 里面
			$('#file_upload').uploadify({
				removeTimeout:99999999999,
				'formData'     : {									// 传递额外参数
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				//'successTimeout' :1,						//The time in seconds to wait for the server’s response when a file has completed uploading.  
																	//After this amount of time, the SWF file will assume success.
				//itemTemplate:'<li id="${fileID}file"><div class="progress"><div class="progressbar"></div></div><span class="filename">${fileName}</span><span class="progressnum">0/${fileSize}</span><a class="uploadbtn">上传</a><a class="delfilebtn">删除</a></li>',
				'width'    : 300,									//设置宽度
				'height'    : 30,
				'buttonText' : 'BROWSE...',
				'fileTypeExts' : '*.gif; *.jpg; *.png',				//文件类型
				'queueID'  : 'some_file_queue',						// 设置队列呈现容器
				'buttonImage' : '/uploadify/add.jpg',
				//'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php',						// 上传处理页面
				//'checkExisting' : '/uploadify/check-exists.php',	//检查文件名是否存在页面
				'auto'     : true,									// 是否自动上传
				'fileSizeLimit' : '100KB',							//大小限制
				//'uploadLimit' : 1									//允许上传的文件数量

				/*EVENTS*/
				// Triggered at the very end of the initialization when Uploadify is first called.
				'onInit'   : function(instance) {													
            		alert('初始化后触发：The queue ID is ' + instance.settings.queueID);
        		},	
				/**
			     * 请求成功
			     * file - The file object that was successfully uploaded
			     * data - The data that was returned by the server-side script (anything that was echoed by the file)
			     * response - The response returned by the server—true on success or false if no response.  If false is returned, after the successTimeout option expires, a response of true is assumed.
			     */
				'onUploadSuccess' : function(file, data, response) {
            		alert('The file ' + file.fileID + ' was successfully uploaded with a response of ' + response + ':' + data);
        		},

        		'onUploadError' : function(file, errorCode, errorMsg, errorString) {
            		//alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
        		},

				// 请求完成
				'onQueueComplete' : function(queueData) {
            		//alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
        		},
			});
		});
	</script>
</body>
</html>