function AddToCard(product_id)
{
    console.info("AddToCard="+product_id);
    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"AddToCard",
            product_id:product_id,
            product_count:1
        },
        function (data) {
            console.info(data);
            if(data.status=="1")
            {

                $(".ProductCountText").html(data.panel_text);
            }

        },"json"
    ); //$.get  END
}
var tt=0;
//Поиск товаров
function Search()
{

    var sphere = '';
    $('.sphere').each(function(i,elem) {
        //console.info($(elem).text(),i);
        if ($(elem).hasClass("active"))
        {
            sphere=sphere+"||"+$(elem).html();
        }

    });

    var dohodnost = $(".input_slider_line").val();
    var vlj_min = $(".input_slider_line_2").val();
    var vlj_max = $(".input_slider_line_4").val();
    var srok = $(".input_slider_line_3").val();

    console.info(sphere,dohodnost,vlj_min,vlj_max,srok);
    $(".product_list").html($("#emptyProduct").html());


    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"Search",
            dohodnost:dohodnost,
            vlj_min:vlj_min,
            vlj_max:vlj_max,
            srok:srok
        },
        function (data)
        {
            console.info(data);
            var arr=data.res;
            arr=arr.split(',');
            var count=parseInt(data.count);
            var i=0;


            //if(count>0)

                /*Херим все*/
                $(".product_list").html("");



           // console.info(arr);
            /*Получить кол-во найденных объектов*/

            /*Получить йих ID*/

            /*Вывести первые 10 шт*/


            var tmp=0;
            /*Перебираем полученные данные*/
           arr.forEach(function(item, i, arr) {
                console.info( i + ": " + item );

               if (tmp==0)
               {
                   AppendProduct2(item);
               }
               else
               {
                   tt=setTimeout(function() {AppendProduct2(item); }, 1000)
               }



           });

               // $(".product_list").html(data);
        },"json"
    ); //$.get  END


}

//Добавдяет продукт в конец

function AppendProduct(arr_id,count,arr)
{
    console.info(arr);
    $(".product_list").append("<div id='elem_"+arr[parseInt(arr_id)]+"'>" +
    "<div class='product_item'>" +
    "<div class='product-border'>" +
    "<img class='preloader' src='loader.GIF'>" +
    "</div>" +
    "</div>" +
    "</div>");

    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"GetProductSingle",
            product_id:arr[parseInt(arr_id)]
        },
        function (data)
        {
            $("#elem_"+arr[parseInt(arr_id)]).html(data);
            console.info(parseInt(arr_id),parseInt(count));
            if(parseInt(arr_id)<=parseInt(count))
              //  AppendProduct(arr_id+1,count,arr);
                setTimeout(function() { AppendProduct(parseInt(arr_id)+1,count,arr) }, 500)

        }
        ,"html"
    ); //$.get  END
}

function AppendProduct2(product_id)
{

    $(".product_list").append("<div id='elem_"+product_id+"'>" +
    "<div class='product_item'>" +
    "<div class='product-border'>" +
    "<img class='preloader' src='loader.GIF'>" +
    "</div>" +
    "</div>" +
    "</div>");

    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"GetProductSingle",
            product_id:product_id
        },
        function (data)
        {
            $("#elem_"+product_id).html(data);

            clearTimeout(tt);


        }
        ,"html"
    ); //$.get  END
}
