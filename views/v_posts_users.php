<h1>Users</h1>

<table border="1">
    <tr>
        <th>First Name</th><th>Last Name</th><th>Follow</th>
        <?php if ($user->role < 2): ?>
            <th>Delete</th>
        <?php endif; ?>
    </tr>
    <?php foreach($users_list as $my_user): ?>
    <tr>
        <!-- Print this user's name -->
        <td><?=$my_user['first_name'] ?></td>
        <td><?=$my_user['last_name'] ?></td>

        <!-- If there exists a connection with this user, show a unfollow link -->
        <?php if(isset($connections[$my_user['user_id']])): ?>
            <td><a href='/posts/unfollow/<?=$my_user['user_id'] ?>'>Unfollow</a></td>
            
        <!-- Otherwise, show the follow link -->
        <?php else: ?>
            <td><a href='/posts/follow/<?=$my_user['user_id'] ?>'>Follow</a></td>
        <?php endif; ?>
        
        <!-- If logged in user is an administrator, show a delete link -->
        <?php if ($user->role < 2): ?>
            <td><a href='/users/delete/<?=$my_user['user_id'] ?>'>Delete</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>

