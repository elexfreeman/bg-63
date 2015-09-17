function AddToCard(product_id)
{
    console.info("AddToCard="+product_id);
    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"AddToCard",
            product_id:product_id,
            product_count:product_count
        },
        function (data) {
            console.info(data);
            if(data.status=="1")
            {

                $(".product_"+product_id).css("background-position","100% -22px");
            }
            else
            {
                $(".product_"+product_id).css("background-position","");

            }

            if(parseInt(data.count)>0)
            {
                $(".top2_cart").html("<span>"+String(data.count)+"</span>")
            }
            else
            {
                $(".top2_cart").html('')
            }

        },"json"
    ); //$.get  END
}
