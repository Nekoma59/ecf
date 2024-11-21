var letters = /^[A-Za-z]+$/;
        // var pass =/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
         // Form validation code will come here.
         function validate() {
         
            if( document.myForm.nom.value == "" ) {
               alert( "Veuillez entrer votre nom!" );
             
               document.myForm.nom.focus() ;
               return false;
            }
            if( !document.myForm.nom.value.match(letters) ) {
               alert( "le nom doit ne contenir que des lettres!" );
           
               document.myForm.nom.focus() ;
               return false;
            }
            if( document.myForm.email.value == "" ) {
            alert( "Veuillez entrer votre email!" );
            document.myForm.EMail.focus() ;
            return false;
         }

            if( document.myForm.prenom.value == "" ) {
               alert( "veuillez entrer votre prenom!" );
               document.myForm.prenom.focus() ;
               return false;}
               
               if( !document.myForm.prenom.value.match(letters) ) {
               alert( "le prenom doit ne contenir que des lettres!" );
           
               document.myForm.prenom.focus() ;
               return false;
            }
            if( document.myForm.mdp.value == "" ) {
               alert( "veuillez entrer votre mdp!" );
               document.myForm.mdp.focus() ;
               return false;}
              /* if( !document.myForm.mdp.value.match(pass) ) {
               alert( "mot de pass doit contenir numero/majuscule/miniscule et au moins 8 caracteres" );
           
               document.myForm.mdp.focus() ;
               return false;
            }*/
               /*if( document.myForm.telephone.value == "" ) {
               alert( "veuillez entrer votre telephone!" );
               document.myForm.telephone.focus() ;
               return false;}  
*/
            
           
            
         }