<?php

session_start();
include ('connection.php');

// kullanıcı giriş yapmadıysa
if(!isset($_SESSION['logged_in'])){
   header('location: ../checkout.php?message=Lütfen siparis vermeden önce giris/kayit olunuz.');


 // kullanıcı giriş yaptıysa
}else{


if(isset($_POST['place_order'])){
   
    //1. user info al ve db'de kaydet
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $city = $_POST['city'];
     $adress = $_POST['adress'];
     $order_cost = $_SESSION['total'];
     $order_status = "ödenmedi";
     $user_id = $_SESSION['user_id'];
     $order_date = date('Y-m-d H:i:s');
    
       $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                   VALUES (?,?,?,?,?,?,?); ");

       $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$adress,$order_date);

       $stmt_status = $stmt->execute();
       
       if(!$stmt_status){
         header('location: index.php');
         exit;
       }


       //2. yeni siparis al ve dbye kaydet
       $order_id = $stmt->insert_id;

       


    //3. ürünleri sepetten al
     foreach($_SESSION['cart']as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];


        //4. tüm ürünleri kaydet
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date) 
                  VALUES(?,?,?,?,?,?,?,?)");

        $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);
        $stmt1->execute();          
     }




    
    
    //5.sepeti bosalt
    //unset($_SESSION['cart']);


    
    
    //6. kullanıcıyı bilgilendir

    $_SESSION['order_id'] = $order_id;

    header('location: ../payment.php?order_status=order placed sucessfully');




}
}




?>