<!-- 
    Form used for viewing files 
-->
<div class="container" width="50%" >
    <form action="index.php" method ="GET">
    <table class="table table-bordered">
        <tr>
            <th>File Name</th>
            <th>File Type</th> 
            <th>Size</th>
            <th>Link</th>
            <th>Delete</th>
        </tr>
        <?php if (is_array($directory) ) : ?> <!-- if the dirrectory is an array-->
        <?php foreach ($directory as $file) : ?> <!-- For every file in the directory folder.-->
            <?php if (is_file($folder.DIRECTORY_SEPARATOR.$file)) : ?> <!-- If this selected index is a file.-->
            <?php $fileInfo = pathinfo($folder.DIRECTORY_SEPARATOR.$file);?> <!-- Grabs the entire path for the file into an array that breaks is into pieces.-->
                <tr>
                    <td><?php echo $file ?>
                        <!-- If the file is an image of some type.-->
                        <?php if ($fileInfo['extension'] === 'png' || $fileInfo['extension'] === 'img' || $fileInfo['extension'] === 'jpg' || $fileInfo['extension'] === 'jpeg') : ?>
                        <!-- display it.-->
                        <img src="./uploads/<?php echo $file;?>" width="80px" height="80px"/>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $fileInfo['extension']; ?></td> 
                    <td><?php echo filesize($folder.DIRECTORY_SEPARATOR.$file) / 1000 . ' kb';?></td>
                    <td><a class="btn btn-default" href="<?php $folder.DIRECTORY_SEPARATOR.$file ?>">Link</a></td>
                    <!--<td hidden><input type="text" name="file" value=" <?php //$file ?>" /></td>-->
                    <td><button type="submit" class="btn btn-warning" name ="delete" value="<?php echo $file ?>">Delete</button></td>
                </tr>
                
            <?php endif; ?>
        <?php endforeach;?>    
        <?php endif; ?>
    </table>
    </form>
</div>
