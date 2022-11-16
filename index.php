<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'process.php'; ?>

    <div class="d-flex justify-content-center mt-4">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" value="<?php echo $name;?>" name="name" placeholder="Your name here">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" type="text" value="<?php echo $location;?>" name="location" placeholder="Your location here">
            </div>
            <div class="form-group">
            
            <?php if($update == true): ?>
            <button type="submit" class="mt-2 btn btn-info" name="update">Update</button>
            <?php else: ?>
            <button type="submit" class="mt-2 btn btn-primary" name="save">Save</button>
            <?php endif; ?>

            </div>
        </form>
    </div>

    <div class="container mt-2">
        <?php
        //nova conexao com o banco de dados
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

        //retorna todos os dados da tabela data(isso nao ira exibir os dados.)
        $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
        ?>

        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>