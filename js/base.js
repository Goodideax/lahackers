$(function(){
        navbod = $('#navigation'); //选择目标元素
    var nav = navbod.position(); //获取目标元素的位置；left,top的值
    navWidth = navbod.width()  //获取目标元素的当前宽度（因为使用position:fixed后，需要设定宽度才能保持元素的原始大小）
    navbod.css('left',nav.left);  //为元素设置X轴的位置
    $(document).scroll(function(){  //监听scroll事件
        navTop = $('body').scrollTop();  //获得当前页面滚动的长度
        if(navTop &gt;= nav.top-50)  //通过对比元素的top值 和 页面滚动长度；如果页面滚动的长度超过元素的top位置时，对元素设定fixed定位。
        {
            navbod.css('position','fixed')
            navbod.css('top','50px')
            navbod.css('z-index','99')
            navbod.css('background','#efefef')
            navbod.css('width',navWidth)
        }else{
            navbod.css('position','static')
            navbod.css('background','none')
        }
    })
})