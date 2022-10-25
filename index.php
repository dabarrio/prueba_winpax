<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <?php
    include './db/conectar_db.php';

    $db = conectarDB();

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        
        $errors = [];

        if($name == ''){
            $errors[] = 'Nombre puede estar vacio';
        }
        if($surname == ''){
            $errors[] = 'Apellido puede estar vacio';
        }
        if($email == ''){
            $errors[] = 'Correo puede estar vacio';
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Tienen que ser un correo';
        }
        if($password == ''){
            $errors[] = 'Correo puede estar vacio';
        }
        if($password1 == ''){
            $errors[] = 'Correo puede estar vacio';
        }
        if($password != $password1){
            $errors[] = 'Los correos deben ser iguales';
        }

        if(empty($errors)){
            $pass_hash =  password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO prueba_winpax.users (name, surname, email, password) VALUES ('$name', '$surname', '$email', '$pass_hash')";
            $resultado = mysqli_query($db, $query);
            if($resultado){
                echo 'Se cargo correctamente';
            }
        }
    }

    ?>
    
    <?php 
    if(!empty($errors)){
        foreach($errors as $error){
            echo $error;
        }
    }
    ?>
    
    <form action="index.php" method="POST">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" placeholder="Nombre" required>

        <label for="surname">Apellido</label>
        <input type="text" id="surname" name="surname" placeholder="Apellido" required>

        <label for="email">Correo</label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" required>

        <label for="password1">Repetir contraseña</label>
        <input type="password" id="password1" name="password1" placeholder="Contraseña" required>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>