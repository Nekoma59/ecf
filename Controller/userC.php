<?php
include 'Config.php';
include '../Model/user.php';

class userC
{
    

    function deleteuser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $db = config::getConnexion();
        try {
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
         $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /*function adduser($user)
    {
        $sql = "INSERT INTO user (nom,prenom,email,mdp,role)  VALUES ( :nom,:prenom, :email,:mdp,:role)";
        $db = config::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':nom',$user->getNom());
            $req->bindValue(':prenom',$user->getPrenom());
            $req->bindValue(':email',$user->getEmail());
            $req->bindValue(':mdp',$user->getMdp());
            $req->bindValue(':role',$user->getRole());
            $req->execute();
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
    }*/
               
      

    function updateuser($user)
    {  $sql= "UPDATE user SET nom = :nom, prenom = :prenom, email = :email,  mdp = :mdp WHERE id= :id";
        $db = config::getConnexion();
        try {
           $req=$db->prepare($sql);
           $req->bindValue(':id',$user->getId());
           $req->bindValue(':nom',$user->getNom());
           $req->bindValue(':prenom',$user->getPrenom());
           $req->bindValue(':email',$user->getEmail());
           $req->bindValue(':mdp',$user->getMdp());
           $req->execute();
         // echo $query->rowCount() . " records UPDATED successfully <br>";
        } 
        catch (PDOException $e) {
           echo 'Erreur'. $e->getMessage();
        }
    }

    function updateuser1($user)
    {  $sql= "UPDATE user SET role =:role WHERE id= :id";
        $db = config::getConnexion();
        try {
           $req=$db->prepare($sql);
           $req->bindValue(':id',$user->getId());
           $req->bindValue(':role',$user->getRole());
           $req->execute();
         // echo $query->rowCount() . " records UPDATED successfully <br>";
        } 
        catch (PDOException $e) {
           echo 'Erreur'. $e->getMessage();
        }
    }
    
    function showuser($id)
    {
        $sql = "SELECT * from user where id = :id";
        $db = config::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':id',$id);
            $req->execute();
            $liste=$req->fetch();
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }


    function showalluser()
            {
                $sql="SELECT * from user";
                $db = config::getConnexion();
                try{
                    $req=$db->query($sql);
                    return $req;
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }
            }


   /*function showuserr($str)
    {
        $sql = "SELECT * FROM user WHERE nom LIKE '%" . $str . "%'";
        $db = config::getConnexion();
        try {
            $req=$db->prepare($sql);
            $req->bindValue(':id',$id);
            $req->execute();
            $liste=$req->fetch();
            return $liste;
        }
         catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    } */
    
    
}
