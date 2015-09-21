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

    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"Search",
            sphere:sphere,
            sphere:sphere,
            sphere:sphere
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
