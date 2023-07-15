<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="uploaded.css">
    <title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
    <li>name: <?= esc($uploaded_fileinfo->getBasename()) ?></li>
    <li>size: <?= esc($uploaded_fileinfo->getSizeByUnit('kb')) ?> KB</li>
    <li>extension: <?= esc($uploaded_fileinfo->guessExtension()) ?></li>
</ul>

<p><?= anchor('upload', 'Upload Another File!') ?></p>

</body>
</html>
