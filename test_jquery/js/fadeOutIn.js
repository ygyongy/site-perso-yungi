$(function()
            {
                $('a#link_effect').click(function ()
                                                  {
                                                        //se charge une fois le chargement du DOM termine
                                                        $('div.fadeOutIn').fadeOut('slow', //premier paramètre - NE PAS OUBLIER LA VIRGULE
                                                                                        function() // deuxième paramètre est une fonction anonyme permettant le fondu enchaine
                                                                                        {
                                                                                            $(this).fadeIn('slow');
                                                                                        } 

                                                                                  );//fin du la fonction fadeout
                                                  }
                )//fin de l'événement click
            }
);//fin de l'appel jQuery