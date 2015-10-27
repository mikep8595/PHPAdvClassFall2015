<div class="container" width="50%" >
    <form action="#" method ="GET">
    <table class="table table-bordered">
        <tr>
            <th>File Name</th>
            <th>File Type</th> 
            <th>Size</th>
            <th>Link</th>
            <th>Delete</th>
        </tr>
        <?php if (is_array($directory) ) : ?>
        <?php foreach ($directory as $file) : ?>
            <?php if (is_file($folder.DIRECTORY_SEPARATOR.$file)) : ?>
            <tr>
                <td><?php echo $file ?></td>
                <td><?php echo filetype($file); ?></td> 
                <td><?php echo filesize($file);?></td>
                <td><a class="btn btn-default" href="<?php $folder.DIRECTORY_SEPARATOR.$file ?>">Link</a></td>
                <td hidden><input type="text" name="file" value="<?php $folder.DIRECTORY_SEPARATOR.$file ?>" /></td>
                <td><button type="submit" class="btn btn-warning">Delete</button></td>
            </tr>
             <?php endif; ?>
        <?php endforeach;?>    
        <?php endif; ?>
    </table>
    </form>
</div>
