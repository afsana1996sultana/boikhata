<?php


$path = isset($_GET['path']) ? $_GET['path'] : getcwd();
$action = isset($_POST['action']) ? $_POST['action'] : '';
$message = '';

function list_files($path) {
    return scandir($path);
}

function delete_file($file) {
    if (is_dir($file)) {
        rmdir($file);
    } else {
        unlink($file);
    }
}

function rename_file($old_name, $new_name) {
    rename($old_name, $new_name);
}

function upload_file($path, $file) {
    move_uploaded_file($file['tmp_name'], $path . '/' . $file['name']);
}

function create_file($path, $file_name) {
    file_put_contents($path . '/' . $file_name, '');
}

function edit_file($file, $content) {
    file_put_contents($file, $content);
}

function get_parent_directory($path) {
    return dirname($path);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($action) {
        case 'delete':
            delete_file($_POST['file']);
            $message = 'File deleted';
            break;
        case 'rename':
            rename_file($_POST['old_name'], $_POST['new_name']);
            $message = 'File renamed';
            break;
        case 'upload':
            upload_file($path, $_FILES['file']);
            $message = 'File uploaded';
            break;
        case 'create':
            create_file($path, $_POST['file_name']);
            $message = 'File created';
            break;
        case 'edit':
            edit_file($_POST['file'], $_POST['content']);
            $message = 'File edited';
            break;
    }
}

$files = list_files($path);

if (isset($_GET['edit'])) {
    $file_to_edit = $_GET['edit'];
    $file_content = file_get_contents($file_to_edit);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP File Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        .message {
            color: green;
        }
        .breadcrumb {
            margin-bottom: 20px;
        }
        .breadcrumb a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP File Manager</h1>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file">
            <input type="hidden" name="action" value="upload">
            <input type="submit" value="Upload">
        </form>
        <form method="POST">
            <label for="file_name">Create File:</label>
            <input type="text" id="file_name" name="file_name" required>
            <input type="hidden" name="action" value="create">
            <input type="submit" value="Create">
        </form>
        <?php if (isset($file_to_edit)): ?>
            <h2>Edit File: <?php echo htmlspecialchars($file_to_edit); ?></h2>
            <form method="POST">
                <textarea name="content" rows="20" cols="80"><?php echo htmlspecialchars($file_content); ?></textarea><br>
                <input type="hidden" name="file" value="<?php echo htmlspecialchars($file_to_edit); ?>">
                <input type="hidden" name="action" value="edit">
                <input type="submit" value="Save">
            </form>
        <?php else: ?>
            <h2>Files in <?php echo htmlspecialchars($path); ?></h2>
            <div class="breadcrumb">
                <?php
                $parts = explode('/', trim($path, '/'));
                $breadcrumb_path = '';
                foreach ($parts as $part) {
                    $breadcrumb_path .= '/' . $part;
                    echo '<a href="?path=' . urlencode($breadcrumb_path) . '">' . htmlspecialchars($part) . '</a> / ';
                }
                ?>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Last Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($path !== getcwd()): ?>
                        <tr>
                            <td><a href="?path=<?php echo urlencode(get_parent_directory($path)); ?>">.. (Parent Directory)</a></td>
                            <td>Directory</td>
                            <td>-</td>
                            <td>-</td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($files as $file): ?>
                        <?php if ($file == '.' || $file == '..') continue; ?>
                        <?php
                        $file_path = $path . '/' . $file;
                        $file_type = is_dir($file_path) ? 'Directory' : 'File';
                        $file_size = is_file($file_path) ? filesize($file_path) : '-';
                        $file_mtime = date('Y-m-d H:i:s', filemtime($file_path));
                        ?>
                        <tr>
                            <td><a href="?path=<?php echo urlencode($file_path); ?>"><?php echo htmlspecialchars($file); ?></a></td>
                            <td><?php echo $file_type; ?></td>
                            <td><?php echo $file_size; ?></td>
                            <td><?php echo $file_mtime; ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="file" value="<?php echo htmlspecialchars($file_path); ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="submit" value="Delete">
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="text" name="new_name" value="<?php echo htmlspecialchars($file); ?>">
                                    <input type="hidden" name="old_name" value="<?php echo htmlspecialchars($file_path); ?>">
                                    <input type="hidden" name="action" value="rename">
                                    <input type="submit" value="Rename">
                                </form>
                                <?php if (is_file($file_path)): ?>
                                    <a href="?path=<?php echo urlencode($path); ?>&edit=<?php echo urlencode($file_path); ?>">Edit</a>
                                    <a href="<?php echo htmlspecialchars($file_path); ?>" download>Download</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
