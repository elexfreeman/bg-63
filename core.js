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
            console.info(data.sql);


            if(count>0)

            {
                /*Херим все*/
                $(".product_list").html("");


                //Запихиваем найденные значения для последующего использования
                $("#emptyProduct").attr('startProduct','30');
                $("#emptyProduct").attr('arr',data.res);
                $("#emptyProduct").attr('count',count);
                PrintProducts(0,arr,count);
            }
            else
            {
                $(".product_list").html("<h2 class='search-res-h2'>Поиск не дал результатов</h2>");
            }





            // console.info(arr);
            /*Получить кол-во найденных объектов*/

            /*Получить йих ID*/

            /*Вывести первые 10 шт*/



               // $(".product_list").html(data);
        },"json"
    ); //$.get  END


}

//Выводит 30 продуктов
function PrintProducts(product_start,arr,count)
{
    var tmp=0;
    var kk=0;
    count=parseInt(count);
    $("#emptyProduct").attr('startProduct',(parseInt(product_start)+30));
    for (var i = product_start; i < (parseInt(product_start)+30); i++)
    {
        if(count<i)
        {
            break;
        }
        else
        {
            AppendProduct2(arr[i]);
        }
    }
    console.info(count,i);
    if(count>=i)
    {
        $('.product_list_all').remove();
        $(".product_list").append('<div class="product_list_all" onclick="PrintProductNext()"><i class="product-icons product-icons-all"></i> Показать еще</div>');
    }

}

//Для вывода следующих 30 элементов при поиске
function PrintProductNext()
{

    //получаем все эелменты
    var startProduct = parseInt($("#emptyProduct").attr('startProduct'));
    var arr = $("#emptyProduct").attr('arr');
    arr=arr.split(',');

    var count = parseInt($("#emptyProduct").attr('count'));


    PrintProducts(startProduct,arr,count);
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
                setTimeout(function() { AppendProduct(parseInt(arr_id)+1,count,arr) }, 1000)

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
