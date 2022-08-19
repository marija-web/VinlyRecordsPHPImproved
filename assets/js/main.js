$(document).ready(function(){

    cartLength();
    $(".cat").change(filterCat);
    $("#search").keyup(searchProducts);
    $(".send").click(clickSurvey);

    //funkcija za ajax
    function ajaxCallBAck(url, method, data, result){
        $.ajax({
            url:url,
            method:method,
            dataType:"json",
            data:data,
            success:result,
            error:function(xhr){
                console.log(xhr);
            }
        });
    }

    ajaxCallBAck("modals/vinylSite/pagination.php", "post", {
        valuePag:0
    }, function(result){
        writeProductsPag(result.products);
    })

    //skladistenje u Local Storage
    function setItemToLocalStorage(name, value){
        localStorage.setItem(name, JSON.stringify(value));
    }
    //vracanje iz Local Storage
    function getItemFromLocalStorage(name){
        return JSON.parse(localStorage.getItem(name));
    }

    // Handle click on paging links
     $('.tm-paging-link').click(function(e){
         e.preventDefault();
        
         var page = $(this).text().toLowerCase();
         $('.tm-gallery-page').addClass('hidden');
         $('#tm-gallery-page-' + page).removeClass('hidden');
         $('.tm-paging-link').removeClass('active');
         $(this).addClass("active");
     });

    //funkcija za toggle
     function addToggle(divHideShow, divShow){
         $(divHideShow).hide();
         $(divShow).click(function(){
             $(divHideShow).slideToggle(1000);
         });
     }
     addToggle("#textFade", "#showText");
     addToggle("#textFade2", "#showText2");

     //funkcija za filtriranje proizvoda
     function filterCat(){
         var valueCat=$("input[name='cat']:checked").val();
         var valueToSend={
             value:valueCat
         };
         ajaxCallBAck("modals/vinylSite/filterCat.php", "post", valueToSend, function(result){
             writeProductsPag(result);
         });
     }

     //funkcija za pretragu proizvoda
     function searchProducts(){
        var valueSearch=$(this).val().toLowerCase();
        var valueSearchToSend={
            valueS:valueSearch
        };
        ajaxCallBAck("modals/vinylSite/search.php", "post", valueSearchToSend, function(result){
            writeProductsPag(result);
        });
    }

     //messages
     $(document).on("click", "#buttonSubmit", function(e){
        e.preventDefault();
        var valid=true;

        var valueMesage=$("#messageInput");
        var idUSer=$("#messageLogesIn").val();

        var messageRegex=/^[A-ZČĆŽŠĐ][a-zčćžšđ\s\.,!?]{11,300}$/; 
    
        //funkcija za proveru regexa
        function formCheck(inputValue, errorSpan, text, regex){
            if(inputValue.val()==""){
                valid=false;
                inputValue.addClass("error");
                $(errorSpan).html("You need to fill out this field.");
            }
            else{
                if(!regex.test(inputValue.val())){
                    valid=false;
                    inputValue.addClass("error");
                    $(errorSpan).html(text);
                }
                else{
                    inputValue.removeClass("error");
                    $(errorSpan).html("");
                }
            }
        }
    
        //message
        formCheck(valueMesage, "#errorMsg", "Message must have at least 12 letters with first letter upper case.", messageRegex);
        
        if(valid){  
            var dataToSend={
                'message':valueMesage.val(),
                'userId':idUSer
            }
        }
    
        $.ajax({
            url:"modals/vinylSite/messagesForm.php",
            method:"post",
            dataType:"json",
            data:dataToSend,
            success:function(result){
                $("#done").html(result);
            },
            error:function(xhr){
                // $("#done").html(xhr.responseText); 
                console.log(xhr);
            }
        })
     });

     //register
     $(document).on("click", "#buttonSubmitR", function(e){
        e.preventDefault();
        var validR=true;
        var valueFistNameR=$("#nameInputR");
        var valueLastNameR=$("#lastNameInputR");
        var valueEmailR=$("#emailInputR");
        var valuePassR=$("#passInputR");
        
        var fullNameRegexR=/^[A-ZČĆŽŠĐ][A-Za-zčćžšđ\s]{2,15}$/;
        var eMailRegexR=/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/;
        var passRegexR=/^.{6,30}$/; 
    
        //funkcija za proveru regexa
        function formCheckR(inputValueR, errorSpanR, textR, regexR){
            if(inputValueR.val()==""){
                validR=false;
                inputValueR.addClass("error");
                $(errorSpanR).html("You need to fill out this field.");
            }
            else{
                if(!regexR.test(inputValueR.val())){
                    validR=false;
                    inputValueR.addClass("error");
                    $(errorSpanR).html(textR);
                }
                else{
                    inputValueR.removeClass("error");
                    $(errorSpanR).html("");
                }
            }
        }
        //firstName
        formCheckR(valueFistNameR, "#errorFirstNameR", "Name not in a good format - start with upper case leading up to at least 3 letters." ,fullNameRegexR);
    
        //lastName
        formCheckR(valueLastNameR, "#errorLastNameR", "Last name not in a good format - start with upper case leading up to at least 3 letters.", fullNameRegexR);
    
        //email
        formCheckR(valueEmailR, "#errorEmailR", "Please enter a valid email address.", eMailRegexR);
    
        //message
        formCheckR(valuePassR, "#errorPassR", "Password not in a good format - it must have at least 6 charachters.", passRegexR);
        
        if(validR){   
            var dataToSendR={
                firstNameR: valueFistNameR.val(),
                lastNameR: valueLastNameR.val(),
                emailR: valueEmailR.val(),
                passR: valuePassR.val()
            }
        }
    
        $.ajax({
            url:"modals/vinylSite/registerForm.php",
            method:"post",
            dataType:"json",
            data:dataToSendR,
            success:function(result){
                $("#doneR").html(result);
                location.reload();
            },
            error:function(xhr){
                // $("#doneR").html(xhr.responseText);
                console.log(xhr);
            }
        })
     });

     //login
     $(document).on("click", "#buttonSubmitL", function(e){
        e.preventDefault();
        var validL=true;
        var valueEmailL=$("#emailInputL");
        var valuePassL=$("#passwordInputL");
        
        var eMailRegexL=/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/;
        var passRegexL=/^.{6,30}$/; 
    
        //funkcija za proveru regexa
        function formCheckL(inputValueL, errorSpanL, textL, regexL){
            if(inputValueL.val()==""){
                validL=false;
                inputValueL.addClass("error");
                $(errorSpanL).html("You need to fill out this field.");
            }
            else{
                if(!regexL.test(inputValueL.val())){
                    validL=false;
                    inputValueL.addClass("error");
                    $(errorSpanL).html(textL);
                }
                else{
                    inputValueL.removeClass("error");
                    $(errorSpanL).html("");
                }
            }
        }
        //email
        formCheckL(valueEmailL, "#errorEmailL", "Please enter a valid email address.", eMailRegexL);
    
        //message
        formCheckL(valuePassL, "#errorPassL", "Password not in a good format - it must have at least 6 charachters.", passRegexL);
        
        if(validL){   
            var dataToSendL={
                emailL: valueEmailL.val(),
                passL: valuePassL.val()   
            }   
        }
    
        $.ajax({
            url:"modals/vinylSite/loginForm.php",
            method:"post",
            dataType:"json",
            data:dataToSendL,
            success:function(result){
                if(result=="Welcome - you have successfully logged in."){
                    window.location.href="index.php?page=mainPage";
                }
                $("#doneL").html(result);
            },
            error:function(xhr){
                console.log(xhr);
            }
        })
     });

     //funckija za anketu
     function clickSurvey(){
         var logedIn=$("#logedIn").val();
         var idSurvey=this.dataset.id;
         var value=$("input[name='survey?"+idSurvey+"']:checked").val();
         var surveyInfo={
             id:idSurvey,
             value:value,
             user:logedIn
         }
         ajaxCallBAck("modals/vinylSite/survey.php", "post", surveyInfo, function(result){
           alert(result);
           $('.survey').prop('checked', false);
        });
     }

     //paginacija
     $(document).on('click', '.clickPag', function(e){
        e.preventDefault();

        var value=$(this).attr("data-limit");
        var valuePag={
            valuePag:value
        }

        ajaxCallBAck("modals/vinylSite/pagination.php", "post", valuePag, function(result){
            writeProductsPag(result.products);
            writePag(result.numPages);
         });

     
    })

     function writeProductsPag(arrayP){
         var html5="";
         if(arrayP.length==0){
             html5+=`<div class="col-12">
             <div class="alert text-center mt-5">Sorry, we will be back in stock soon with new arrivals.</div>
             </div>`
         }
         else{
            for(var obj2 of arrayP){
                html5+=`<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                <figure>
                <a href="index.php?page=showProduct&id=${obj2.id_products}"><img src="assets/img/gallery/smallGallery/Small${obj2.picture_src}" alt="${obj2.name_products}" class="img-fluid tm-gallery-img"/></a>
                    <figcaption>
                        <h4 class="tm-gallery-title">${obj2.name_products}</h4>
                        <p>Artist - ${obj2.name_artist}</p>
                        <p>${obj2.name_cat}</p>
                        <hr>
                        <p class="text-secondary">${writeDelivery(obj2.delivery)}</p>
                        <input type="button" value="Add to cart" class="tm-btn tm-btn-success addToCart" data-idcart="${obj2.id_products}" ${disabled()}/>
                        <p>${writeMsg()}</p>
                        <p class="tm-gallery-price">$${writePrice(obj2.price_now, obj2.price_old)}
                        </p>
                    </figcaption>
                </figure>
            </article>`
            }
         }
         $("#products").html(html5);
         $('.addToCart').click(toCart);
     }

     function disabled(){
         var html15="";
         var session = $('#session').val();
         if(session=="0"){
            html15+="disabled";
         }
         else{
             html15+="";
         }
         return html15;
     }

     function writeMsg(){
         var html16="";
         var session = $('#session').val();
         if(session=="0"){
             html16+="Log in for cart.";
         }
         else{
             html16+="";
         }
         return html16;
     }

     function writePag(numberPages){
        var html6="";

        for(var i=0; i<numberPages; i++){
           html6+=`<li class="page-item"><a class="page-link clickPag" href="#" data-limit="${i}">${(i+1)}</a></li>`
        }
        $("#pag").html(html6);
    }

      $.ajax({
        url:"modals/vinylSite/getProducts.php",
        method:"get",
        dataType:"json",
        success:function(result){
            setItemToLocalStorage("products", result);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
      
      //funkcije za korpu na shop.php
    function cartLength(){
        var cartItems=getItemFromLocalStorage("cartItems");
        if(cartItems!=null){
            var nmbOfProd=cartItems.length;
            $("#countCart").html(nmbOfProd);
        }
    }
    if(document.URL.includes("index.php?page=shop")){
        function toCart(){
            var products=getItemFromLocalStorage("products");
            var idCart=$(this).attr('data-idcart');
            var currentLS=catchAll();
            var objectProduct=products.filter(p=>p.id_products==idCart);
            if(!currentLS){
                notInCurrentLS(objectProduct);
            }
            else{
                var isInCart=currentLS.some(s=>s.id_products==idCart);
                if(!isInCart){
                    notInCart(objectProduct, currentLS);
                }
                else{
                    alreadyExists(currentLS, idCart);
                }
                setItemToLocalStorage("cartItems", currentLS);
                cartLength();
            }
            alertAddToCart();
        }

        function alertAddToCart(){
            alert("Album has been added to the cart.");
        }

        function catchAll(){
            return getItemFromLocalStorage("cartItems");
        };

        function notInCurrentLS(objectProduct){
            objectProduct[0].quantity=1;
            setItemToLocalStorage("cartItems", objectProduct);
            cartLength();
        }

        function notInCart(objectProduct, currentLS){
            objectProduct=objectProduct[0];
            objectProduct.quantity=1;
            currentLS.push(objectProduct);
            cartLength();
        }

        function alreadyExists(currentLS, idCart){
            currentLS=currentLS.map(m=>{
                if(m.id_products == idCart){
                    m.quantity+=1;
                }
                return m;
            });
        }

        $("#ddlListSort").change(sortDDL);

        function sortDDL(){
            var valueSort=$(this).val();
            var valueToSendDDL={
                valueSort:valueSort
            }

        ajaxCallBAck("modals/vinylSite/sortDDL.php", "post", valueToSendDDL, function(result){
            writeProductsPag(result);
        })
        }
    }

    //funckije za korpu na cart.php
    if(document.URL.includes("index.php?page=cart")){
        var cartItems=getItemFromLocalStorage("cartItems")
        if(cartItems==null){
            $("#cartEmpty").html("Your cart is empty - go back to shopping.");
        }
        else{
            checkCart();
        } 
    
        function checkCart(){
            var cartItems=getItemFromLocalStorage("cartItems");
            html8="";
            html8+=`<table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th class="col-5 ">Product</th>
                <th class="col-2">Price</th>
                <th  class="col-1">Quantity</th>
                <th  class="col-3 text-center">Total</th>
                <th  class="col-2">Remove</th>
            </tr>
            </thead>`
            for(var obj7 of cartItems){
                html8+=` <tbody> 
                <tr>
                    <td data-th="Product">
                            <div class="col-sm-2 hidden-xs mr-5" >
                                <img src="assets/img/gallery/smallGallery/Small${obj7.picture_src}" alt="${obj7.name_products}" class="img-responsive"/>
                            </div>
                            <div class="col-sm-5">
                                <h5>${obj7.name_products}</h5>
                            </div>
                    </td>
                    <td data-th="Price">$${obj7.price_now}</td>
                    <td data-th="Quantity">
                        <p id=${obj7.quantity} class="text-center">${obj7.quantity}</p>
                    </td>
                    <td data-th="Total" class="text-center">$${(obj7.price_now * obj7.quantity)}</td>
                    <td class="actions" >
                        <a href="#" class="tm-btn tm-btn-success remove" data-id="${obj7.id_products}" >Remove</a>
                    </td>
                </tr> 
            </tbody>`
            }
            html8+=`<tfoot>
            <tr>
                <td><a href="shop.php#shop" class="tm-btn tm-btn-success"><i class="fa fa-angle-left"></i>Back</a></td>
                <td colspan="1" class="hidden-xs"></td>
                <td><a href="#" class="tm-btn tm-btn-success" id="clear">Clear</a></td>
                <td class="text-center"><strong>Total $${totalCost()}</strong></td>
                <td><a href="#" class="tm-btn tm-btn-success" id="finish">Finish</a></td>

            </tr>
        </tfoot>
        <table>`
            $("#cartWrite").html(html8);
        }

        $("#finish").click(alertFinish);
        $("#clear").click(clearCartAll);
        $(".remove").click(removeCartItem);

        function alertFinish(e){
            e.preventDefault();
            if(cartItems.length!=0){
                var idUser=$("#cartUser").val();
                var data={
                    idUser:idUser
                };
                let cart;
                for(let i=0; i<cartItems.length; i++){
                    cart="cart"+i;
                    data[cart]=cartItems[i];
                }
                ajaxCallBAck("modals/vinylSite/insertCart.php", "post", data, function(result){
                alert(result);
                localStorage.removeItem("cartItems");
                location.reload();
                })    
            }
        }
        
        function clearCartAll(e){
            e.preventDefault();
            localStorage.removeItem("cartItems");
            location.reload();
        }

        function removeCartItem(e){
            e.preventDefault();
            var cartItems=getItemFromLocalStorage("cartItems");
           
            var idR=$(this).attr("data-id");
            var removeFilter=cartItems.filter(c=>c.id_products!=idR);
        
            setItemToLocalStorage("cartItems", removeFilter);
            location.reload();
        }

        function totalCost(){
            for(var obj8 of cartItems){
                if(cartCost!=null){
                    setItemToLocalStorage("totalCost", getItemFromLocalStorage("totalCost") + obj8.price_now * obj8.quantity);
                }
                else{
                    setItemToLocalStorage("totalCost", obj8.price_now  * obj8.quantity);
                }
                var cartCost=getItemFromLocalStorage("totalCost");
            }
            if(cartCost!=null){
                return cartCost;
            }
            else{
                return 0;
            }
        }
    }

    //funkcija za ispisivanje delivery-a
    function writeDelivery(delivery){
            var html2="";
            if(delivery==1){
                html2+="Free delivery";
            }
            else{
               html2+="";
            }
            return html2;
    }

    //funkcija za ispisivanje cene
    function writePrice(priceNow, priceOld){
           var html3="";
           if(priceOld!=null){
               html3+=`${priceNow}
               $<del>${priceOld}</del>`
           }
           else{
               html3+=`${priceNow}`
           }
           return html3;
    }

    //ADMIN PANEL

    // funckija za poruke(delete) i statistika ankete
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=messagesSurvey")){
        $(document).on("click", ".idDelete", function(e){
            e.preventDefault();
            var idMessage=$(this).attr("data-id");
            var idToSend={
                id:idMessage
            }
    
            ajaxCallBAck("modals/adminPanel/deleteMessage.php", "post", idToSend, function(result){
               writeMsgAfterDelete(result);
             });
         })
         
         //delete poruke
         function writeMsgAfterDelete(arrayMsg){
             var html9="";
             var rb=1;
             html9+=`<table class="table">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">First Name</th>
                 <th scope="col">Last Name</th>
                 <th scope="col">Email</th>
                 <th scope="col">Message</th>
               </tr>
             </thead>
             <tbody>`;
             for(var obj9 of arrayMsg){
                 html9+=`<tr>
                 <th scope="row">${rb}</th>
                 <td>${obj9.name_user}</td>
                 <td>${obj9.lastname_user}</td>
                 <td>${obj9.email_user}</td>
                 <td>${obj9.message_user}</td>
                 <td><a href="#" data-id="${obj9.id_msg}" class="idDelete">Delete</a></td>
               </tr>`
               rb++;
             }
             html9+=`</tbody>
             </table>`;
             $("#messages").html(html9);
         }
    }

    //anketa
    ajaxCallBAck("modals/vinylSite/getActivNoActiv.php", "get", {button:true}, function(result){
        var valueC;
        for(var obj16 of result){
            valueC=$("#chb"+obj16.idSurvey).val();
            if(obj16.idSurvey==valueC){
                if(obj16.activ==1){
                    $("#chb"+valueC).prop('checked', true);
                }
                else{
                    $("#chb"+valueC).prop('checked', false);
                }
            }
        }
    });

    $(document).on("click", ".activ", function(){
        var value=$(this).val();
        var check="";
        if($('.activ').is(':checked')){
            check=1;
            console.log("da");
        }
        else{
            check=0;
            console.log("ne");
        }

        var dataToSendA={
            value:value,
            check:check
        }
        
        ajaxCallBAck("modals/vinylSite/activeSurvey.php", "post", dataToSendA, function(result){
            alert(result);
        });
     })

    //funkcija za update admin profila
    if(document.URL.includes("index.php?page=adminPanel")){

        $("#updateAdmin").click(updateAdmin);

        function updateAdmin(){
           var nameAdmin=$("#nameInputAdmin").val();
           var lastNameAdmin=$("#lastNameInputAdmin").val();
           var emailAdmin=$("#emailInputAdmin").val();
           var valid=true;
           if(nameAdmin=="" || lastNameAdmin=="" || emailAdmin==""){
               valid=false;
           }
           else{
               valid=true;
           }

           if(valid){
                var dataToSendA={
                    nameAdmin:nameAdmin,
                    lastNameAdmin:lastNameAdmin,
                    emailAdmin:emailAdmin
             }

            ajaxCallBAck("modals/adminPanel/updateAdmin.php", "post", dataToSendA, function(result){
                alert(result);
                location.reload();
              });
           }
        }
    }

    //funckija za menu(delete, insert, update)
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=menuTable")){
        //delete menu
        $(document).on("click", ".deleteMenu", function(e){
            e.preventDefault();
            var dataMenu=$(this).attr("data-id");
            var dataToSendM={
                dataMenu:dataMenu
            }

            ajaxCallBAck("modals/adminPanel/deleteMenu.php", "post", dataToSendM, function(result){
                writeMenu(result);
            });
        })
        function writeMenu(arrayMenu){
            var html10="";
            html10+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_menu</th>
                <th scope="col">name_menu</th>
                <th scope="col">href_menu</th>
                <th scope="col">show_menu</th>
                <th scope="col">priority_menu</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj10 of arrayMenu){
                html10+=`<tr>
                <th scope="row">${obj10.id_menu}</th>
                <td><input type="text" id="nameMenu${obj10.id_menu}" class="form-control" value="${obj10.name_menu}"></td>
                <td><input type="text" id="hrefMenu${obj10.id_menu}" class="form-control" value="${obj10.href_menu}" disabled></td>
                <td><input type="text" id="showMenu${obj10.id_menu}" class="form-control" value="${obj10.show_menu}"></td>
                <td><input type="text" id="priorityMenu${obj10.id_menu}" class="form-control" value="${obj10.priority_menu}"></td>
                <td><a href="#" data-id="${obj10.id_menu}" class="updateMenu">Update</a></td>
                <td><a href="#" data-id="${obj10.id_menu}" class="deleteMenu">Delete</a></td>
              </tr>`
            }
            html10+=` </tbody>
            </table`;
            $("#menu").html(html10);
        }
        //update menu
        $(document).on("click", ".updateMenu", function(e){
            e.preventDefault();
            var dataMenu=$(this).attr("data-id");
            var nameMenu=$("#nameMenu"+dataMenu).val();
            var hrefMenu=$("#hrefMenu"+dataMenu).val();
            var showMenu=$("#showMenu"+dataMenu).val();
            var priorityMenu=$("#priorityMenu"+dataMenu).val();

            var dataToSendM={
                dataMenu:dataMenu,
                nameMenu:nameMenu,
                hrefMenu:hrefMenu,
                showMenu:showMenu,
                priorityMenu:priorityMenu
            }

            ajaxCallBAck("modals/adminPanel/updateMenu.php", "post", dataToSendM, function(result){
                writeMenu(result);
              });
        })
        //insert menu
        $(document).on("click", "#insertMenu", function(e){
           e.preventDefault();
           var nameMenu=$("#nameMenu").val();
           var hrefMenu=$("#hrefMenu").val();
           var showMenu=$("#showMenu").val();
           var priorityMenu=$("#priorityMenu").val();
           var valid=true;

           if(nameMenu=="" || hrefMenu=="" || showMenu=="" || priorityMenu==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendM={
                    nameMenu:nameMenu,
                    hrefMenu:hrefMenu,
                    showMenu:showMenu,
                    priorityMenu:priorityMenu
                }
            }
           
        ajaxCallBAck("modals/adminPanel/insertMenu.php", "post", dataToSendM, function(result){
            alert(result);
            location.reload();
        });

        })
    }

    //funckija za category(delete, insert, update)
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=categoryTable")){
        //delete category
        $(document).on("click", ".deleteCategory", function(e){
            e.preventDefault();
            var dataCat=$(this).attr("data-id");
            var dataToSendC={
                dataCat:dataCat
            }

            ajaxCallBAck("modals/adminPanel/deleteCategory.php", "post", dataToSendC, function(result){
                writeCategory(result);
            });
        })
        function writeCategory(arrayCat){
            var html11="";
            html11+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_cat</th>
                <th scope="col">name_cat</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj11 of arrayCat){
                html11+=` <tr>
                <th scope="row">${obj11.id_cat}</th>
                <td><input type="text" id="nameCategory${obj11.id_cat}" class="form-control" value="${obj11.name_cat}"></td>
                <td><a href="#" data-id="${obj11.id_cat}" class="updateCategory">Update</a></td>
                <td><a href="#" data-id="${obj11.id_cat}" class="deleteCategory">Delete</a></td>
              </tr>`
            }
            html11+=` </tbody>
            </table`;
            $("#category").html(html11);
        }
        //update category
        $(document).on("click", ".updateCategory", function(e){
            e.preventDefault();
            var dataCategory=$(this).attr("data-id");
            var nameCategory=$("#nameCategory"+dataCategory).val();

            var dataToSendC={
                dataCategory:dataCategory,
                nameCategory:nameCategory,
            }

            ajaxCallBAck("modals/adminPanel/updateCategory.php", "post", dataToSendC, function(result){
                writeCategory(result);
              });
        })
        //insert category
        $(document).on("click", "#insertCategory", function(e){
           e.preventDefault();
           var nameCategory=$("#nameCategory").val();
           var valid=true;

           if(nameCategory==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendC={
                    nameCategory:nameCategory,
                }
            }
           
        ajaxCallBAck("modals/adminPanel/insertCategory.php", "post", dataToSendC, function(result){
            alert(result);
            location.reload();
        });

        })
    }

    //funckija za artist(delete, insert, update)
     if(document.URL.includes("index.php?page=adminPanel&adminPanel=artistTable")){
        //delete artist
        $(document).on("click", ".deleteArtist", function(e){
            e.preventDefault();
            var dataArtist=$(this).attr("data-id");
            var dataToSendA={
                dataArtist:dataArtist
            }

            ajaxCallBAck("modals/adminPanel/deleteArtist.php", "post", dataToSendA, function(result){
                writeArtist(result);
            });
        })
        function writeArtist(arrayArtist){
            var html12="";
            html12+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_cat</th>
                <th scope="col">name_cat</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj12 of arrayArtist){
                html12+=` <tr>
                <th scope="row">${obj12.id_artist}</th>
                <td><input type="text" id="nameArtist${obj12.name_cat}" class="form-control" value="${obj12.name_artist}"></td>
                <td><a href="#" data-id="${obj12.id_artist}" class="updateArtist">Update</a></td>
                <td><a href="#" data-id="${obj12.id_artist}" class="deleteArtist">Delete</a></td>
              </tr>`
            }
            html12+=` </tbody>
            </table`;
            $("#artist").html(html12);
        }
        //update artist
        $(document).on("click", ".updateArtist", function(e){
            e.preventDefault();
            var dataArtist=$(this).attr("data-id");
            var nameArtist=$("#nameArtist"+dataArtist).val();
            var dataToSendA={
                dataArtist:dataArtist,
                nameArtist:nameArtist,
            }

            ajaxCallBAck("modals/adminPanel/updateArtist.php", "post", dataToSendA, function(result){
                writeArtist(result);
              });
        })
        //insert category
        $(document).on("click", "#insertArtist", function(e){
           e.preventDefault();
           var nameArtist=$("#nameArtist").val();
           var valid=true;

           if(nameArtist==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendA={
                    nameArtist:nameArtist,
                }
            }
           
        ajaxCallBAck("modals/adminPanel/insertArtist.php", "post", dataToSendA, function(result){
            alert(result);
            location.reload();
        });

        })
    }

    //funckija za price(insert)
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=priceTable")){
        //update price
        $(document).on("click", ".updatePrice", function(e){
            e.preventDefault();
            var dataPrice=$(this).attr("data-id");
            var priceOld=$("#priceOld"+dataPrice).val();
            var priceNow=$("#priceNow"+dataPrice).val();
            var dataToSendP={
                dataPrice:dataPrice,
                priceOld:priceOld,
                priceNow:priceNow
            }

            ajaxCallBAck("modals/adminPanel/updatePrice.php", "post", dataToSendP, function(result){
                alert(result);
            });
        })
    }

    //funckija za usere(delete)
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=usersTable")){
        //delete artist
        $(document).on("click", ".deleteUser", function(e){
            e.preventDefault();
            var dataUser=$(this).attr("data-id");
            var dataToSendU={
                dataUser:dataUser
            }

            ajaxCallBAck("modals/adminPanel/deleteUser.php", "post", dataToSendU, function(result){
                writeUsers(result);
            });
        })

        function writeUsers(arrayUsers){
            var html13="";
            html13+=`<table class="table"> 
            <thead>
              <tr>
              <th scope="col">id_user</th>
              <th scope="col">name</th>
              <th scope="col">last name</th>
              <th scope="col">email</th>
              <th scope="col">role</th>
              <th scope="col">time</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj13 of arrayUsers){
                html13+=`<tr><th scope="row">${obj13.id_user}</th>
                <td id="nameUser${obj13.id_user}">${obj13.name_user}</td>
                <td id="lastNameUser${obj13.id_user}">${obj13.lastname_user}</td>
                <td id="emailUser${obj13.id_user}">${obj13.email_user}</td>
                <td id="roleUser${obj13.id_user}">${obj13.role}</td>
                <td id="timeUser${obj13.id_user}">${obj13.time_register}</td>
                <td><a href="#" data-id="${obj13.id_user}" class="updateUser">Update role</a></td>
                <td><a href="#" data-id="${obj13.id_user}" class="deleteUser">Delete</a></td></tr>`
            }
            html13+=` </tbody>
            </table`;
            $("#users").html(html13);
        }
    }

    //funckija za roles(delete, insert, update)
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=rolesTable")){
        //delete role
        $(document).on("click", ".deleteRole", function(e){
            e.preventDefault();
            var dataRole=$(this).attr("data-id");
            var dataToSendR={
                dataRole:dataRole
            }

            ajaxCallBAck("modals/adminPanel/deleteRole.php", "post", dataToSendR, function(result){
               writeRoles(result);
            });
        })
        function writeRoles(arrayRoles){
            var html13="";
            html13+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_roles</th>
                <th scope="col">role</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj13 of arrayRoles){
                html13+=`<tr>
                <th scope="row">${obj13.id_roles}</th>
                <td><input type="text" id="nameRole${obj13.id_roles}" class="form-control" value="${obj13.role}"></td>
                <td><a href="#" data-id="${obj13.id_roles}" class="updateRole">Update</a></td>
                <td><a href="#" data-id="${obj13.id_roles}" class="deleteRole">Delete</a></td>
              </tr>`
            }
            html13+=` </tbody>
            </table`;
            $("#roles").html(html13);
        }
        //update role
        $(document).on("click", ".updateRole", function(e){
            e.preventDefault();
            var dataRole=$(this).attr("data-id");
            var nameRole=$("#nameRole"+dataRole).val();
            var dataToSendR={
                dataRole:dataRole,
                nameRole:nameRole,
            }

            ajaxCallBAck("modals/adminPanel/updateRoleUser.php", "post", dataToSendR, function(result){
                writeRoles(result);
            });
        })
        //insert role
        $(document).on("click", "#insertRole", function(e){
           e.preventDefault();
           var nameRole=$("#nameRole").val();
           var valid=true;

           if(nameRole==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendR={
                    nameRole:nameRole,
                }
            }
           
        ajaxCallBAck("modals/adminPanel/insertRole.php", "post", dataToSendR, function(result){
            alert(result);
            location.reload();
        });
        })
    }

    //funckija za products(delete, insert, update)
    if(document.URL.includes("index.php?page=adminPanel&adminPanel=productsTable")){
        //delete product
        $(document).on("click", ".deleteProduct", function(e){
            e.preventDefault();
            var dataProduct=$(this).attr("data-id");
            var dataToSendP={
                dataProduct:dataProduct
            }

            ajaxCallBAck("modals/adminPanel/deleteProduct.php", "post", dataToSendP, function(result){
                writeProducts(result.products, result.cat);
            });
        })
        function writeProducts(arrayProducts, arrayCat){
            var html14="";
            html14+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_products</th>
                <th scope="col">name_products</th>
                <th scope="col">picture_src</th>
                <th scope="col">change src</th>
                <th scope="col">name_cat</th>
                <th scope="col">delivery</th>
                <th scope="col">name_artist</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj14 of arrayProducts){
                html14+=`  <tr>
                <th scope="row">${obj14.id_products}</th>
                <td><input type="text" id="nameProducts${obj14.id_products}" class="form-control" value="${obj14.name_products}"></td>
                <td><input type="text" id="srcProducts${obj14.id_products}" class="form-control" value="${obj14.picture_src}" disabled></td>
                <td><input type="file" id="fileProducts${obj14.id_products}" class="form-control-file"></td>
                <td>
                    <div class="form-group">
                           <select class="form-select product${obj14.id_products}" aria-label="Default select example">
                            <option selected value="${obj14.id_cat}">${obj14.name_cat}</option>`
                for(var obj15 of arrayCat){
                    html14+=`<option value="${obj15.id_cat}">${obj15.name_cat}</option>`
                }
                html14+=` </select>
                </div>
                </td>
                <td><input type="number" id="deliveryProducts${obj14.id_products}" class="form-control" value="${obj14.delivery}"></td>
                <td><input type="text" id="artistProducts${obj14.id_products}" class="form-control" value="${obj14.name_artist}" disabled></td>
                <td><input type="text" id="description${obj14.description}" class="form-control" value="${obj14.description}"></td>
                <td><a href="#" data-id="${obj14.id_products}" class="updateProduct">Update</a></td>
                <td><a href="#" data-id="${obj14.id_products}" class="deleteProduct">Delete</a></td>
              </tr>`
            }
            html14+=` </tbody>
            </table`;
            $("#productss").html(html14);
        }
        //update products
        $(document).on("click", ".updateProduct", function(e){
            e.preventDefault();
            var dataProducts=$(this).attr("data-id");
            var nameProducts=document.getElementById("nameProducts"+dataProducts).value;
            // var catValue=getItemFromLocalStorage("catValue");
            // var catValue=document.getElementById("product").value;
            var catValue=$(".product"+dataProducts).val();
            console.log(catValue)
            var delivery=document.getElementById("deliveryProducts"+dataProducts).value;
            var description=document.getElementById("description"+dataProducts).value;
            var filePicture=document.getElementById("fileProducts"+dataProducts).files[0];
            var srcProducts=document.getElementById("srcProducts"+dataProducts).value;
            var picture;
            var valid=true;

            if(nameProducts==""){
                valid=false;
            }
            else{
                valid=true;
            }   
            if(filePicture==undefined){
                picture=srcProducts;
            }
            else{
                picture=filePicture;
            } 

            if(valid){
                var dataToSend=new FormData();
                dataToSend.append("dataProducts",dataProducts) 
                dataToSend.append("nameProducts",nameProducts) 
                dataToSend.append("catValue",catValue) 
                dataToSend.append("delivery",delivery) 
                dataToSend.append("filePicture",picture)
                dataToSend.append("description",description) 
               }

               $.ajax({
                url:"modals/adminPanel/updateProduct.php",
                method:"post",
                dataType:"json",
                data:dataToSend,
                processData:false,
                contentType:false,
                success:function(result){
                    alert(result.msg);
                    writeProducts(result.products, result.cat);
                    localStorage.removeItem("catValue");
                },
                error:function(xhr){
                   console.log(xhr);
                }
            });
        })

        $(document).on("change", "#catInsert", function(){
            var catValueInsert=document.getElementById("catInsert").value;
            setItemToLocalStorage("catValueInsert", catValueInsert);
        })
        $(document).on("change", "#artistInsert", function(){
            var artistValueInsert=document.getElementById("artistInsert").value;
            setItemToLocalStorage("artistValueInsert", artistValueInsert);
        })
        //insert product
        $(document).on("click", "#insertProduct", function(e){
           e.preventDefault();
           var nameProduct=document.getElementById("nameProduct").value;
           var priceProduct=document.getElementById("priceProduct").value;
           var delivery=document.getElementsByName('delivery');
            for(var i=0; i<delivery.length; i++){
                if(delivery[i].checked){
                   delivery=delivery[i].value; 
                }
            }
           var catValue=getItemFromLocalStorage("catValueInsert");
           var artistValue=getItemFromLocalStorage("artistValueInsert");
           var filePicture=document.getElementById("fileProducts").files[0];
           var description=document.getElementById("description").value;
           var valid=true;

           if(nameProduct==""){
               valid=false;
                if(!delivery=="0" && !delivery=="1"){
                    valid=false;
                    $("#error").html("Please select delivery or not delivery");
                }
                else{
                    valid=true;
                }
                if(catValue=="0" || artistValue=="0"){
                    valid=false;
                }
                else{
                    valid=true;
                }
            }
            else{
                valid=true;            
            }
           
           if(valid){
            var dataToSendP=new FormData();
            dataToSendP.append("filePicture",filePicture) 
            dataToSendP.append("nameProduct",nameProduct) 
            dataToSendP.append("priceProduct",priceProduct) 
            dataToSendP.append("delivery",delivery) 
            dataToSendP.append("catValue",catValue) 
            dataToSendP.append("artistValue",artistValue) 
            dataToSendP.append("description",description)
           }
               
           $.ajax({
            url:"modals/adminPanel/insertProduct.php",
            method:"post",
            dataType:"json",
            data:dataToSendP,
            processData:false,
            contentType:false,
            success:function(result){
                alert(result);
            location.reload();
            localStorage.removeItem("catValueInsert");
            localStorage.removeItem("artistValueInsert");
            },
            error:function(xhr){
                console.log(xhr);
            }
        });
        })
    }
    
});
