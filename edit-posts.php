<?php
session_start();
$_SESSION['old_page'] = 'edit-posts.php';
include('requires/header.php');
?>

<h1>LIST OF DETAILS:</h1>	
<table>		
    <thead>			
        <tr>				
            <td>Username</td>				
            <td>Post:</td>				
            <td>Created on:</td>
            <td>Option:</td>
        </tr>		
    </thead>	
    <tbody>		

        <?php	
        include ('requires/database-preamble.php');
        $res = pg_query_params($db, 'SELECT id, username, body, created FROM posts where username = $1',[$LS->getUser("username")]);	
        while($line = pg_fetch_row($res)){ ?>	
        <tr>		
            <td>	
                <?php echo $line[1];?> <!--username-->
            </td>	
            <td>	
                <?php echo $line[2];?> <!--body-->
            </td>	
            <td>	
                <?php echo $line[3];?> <!--created-->
            </td>	
            <td>
            <a href="edit-post.php?id=<?php echo $line[0];?>">                
            <button type="button" class="btn btn-info">Edit Post
            </button>                
            </a>  
            <a href="delete-post.php?id=<?php echo $line[0];?>">                
            <button type="button" class="btn btn-info">Delete Post
            </button>                
            </a>   
            </td>
        </tr>	
        <?php		
        }	
        ?>	
    </tbody>	
</table>
<?php
include ('requires/footer.php');
?>
