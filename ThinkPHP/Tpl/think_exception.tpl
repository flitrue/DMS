<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>404</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
html{ overflow-y: scroll; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
img{ border: 0; }

.face{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
h1{ font-size: 32px; line-height: 48px; }
.error .content{ padding-top: 10px}
.error .info{ margin-bottom: 12px; }
.error .info .title{ margin-bottom: 3px; }
.error .info .title h3{ color: #000; font-weight: 700; font-size: 16px; }
.error .info .text{ line-height: 24px; }
</style>

    <style type="text/css">
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            width: 100%;
        }

        .content1 {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="content1">
        <div class="title">404 Not Found</div>
    </div>
</div>

<div class="error">
    <div class="content">
        <?php if(isset($e['file'])) {?>
        <div class="info">
        <div class="title">
        <h3>错误位置</h3>
        </div>
        <div class="text">
        <p>FILE: <?php echo $e['file'] ;?> &#12288;LINE: <?php echo $e['line'];?></p>
        </div>
        </div>
        <?php }?>
        <?php if(isset($e['trace'])) {?>
        <div class="info">
        <div class="title">
        <h3>TRACE</h3>
        </div>
        <div class="text">
        <p><?php echo nl2br($e['trace']);?></p>
        </div>
        </div>
        <?php }?>
    </div>
</div>
</body>
</html>
