@extends("theme.base")

@section("title")
AVC Tech
@endsection

@section("head")
<link rel="stylesheet" href="/static/css/templates/home/header.css"/>
<link rel="stylesheet" href="/static/css/home/home.css"/>
<link href="https://cdn.jsdelivr.net/gh/avc-tech/TextFlowJS@1.0.2/style.css" rel="stylesheet">
<script src="/static/js/templates/home/header.js"></script>
<script src="/static/js/request-animation-frame.js"></script>
<script src="https://cdn.jsdelivr.net/gh/avc-tech/TextFlowJS@1.0.2/textWrap.js" type="text/javascript" charset="utf-8">
</script>

@endsection
@section("background-image")
/static/images/backgrounds/bg-2.jpg
@endsection
@section("script-onscroll")
/*
if(window.scrollY >= window.innerHeight/3 - 20) $('#home-button-1')[0].classList.add("scrolled");
else $('#home-button-1')[0].classList.remove("scrolled");*/
if(window.scrollY >= 50)
{
    $(".header-menu")[0].classList.add("scrolled");
    $(".header-brand")[0].classList.add("scrolled");
    $("#home-block-1")[0].classList.add("scrolled");
}
else
{
    $(".header-menu")[0].classList.remove("scrolled");
    $(".header-brand")[0].classList.remove("scrolled");
    $("#home-block-1")[0].classList.remove("scrolled");
}
if(window.scrollY >= $("#home-block-1")[0].offsetTop)
{
    showTopBar();
    showMenuIcon();
}
else
{
   hideTopBar();
   hideMenuIcon();
}
@endsection
@section("script-onload")
setHeaderEvents();
/*obj = avcWrapAll();
obj.cursorColor = "#12121290";
obj.start(2000);*/
obj = avcWrapOne(0,"slogan-text");
obj.textColor = "#ffffff90";
obj.cursorColor = "#ffffff";
obj.start(2000)
@endsection

@section("body")
@include("templates.home.header")
<div class="block color-white flex-centerd">
    <div id="home-block-1" class="home-blocks">
        <h3>Projects</h3>
        <div class="projects">
        	@foreach($projects as $pro)
            <div class="project-item">
            	<h4>{{$pro->name}}</h4>
            	<p>{{$pro->description}}</p>
            	<div class="view-link"><a href="/projects/{{$pro->project_id}}">View More >></a></div>
            </div>
            @endforeach
            <div class="view-all"><a href="/projects">More ></a></div>
        </div>
    </div>
</div>
<div class="block block-white">
<h4 class="texter">HI ALL WELCOME TO MY WEBSITE</h4>
<b>What is AVC Tech?</b><br/>
AVC is nothing just the short form of my name Aswanth VC. I'm a programmer and  i made this website to publish my personal projects. All of you can get and use my projects using this website either paid or not.
</div>
<div class="block color-white">
<h4>Lorem Ipusam </h4>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla efficitur ex ut purus feugiat, eget consequat dolor malesuada. Proin tincidunt, tortor sit amet feugiat accumsan, arcu dolor condimentum libero, ultrices vestibulum diam risus quis turpis. Morbi id egestas enim. Quisque pharetra turpis nulla, quis luctus nisi tempor id. Vivamus ornare blandit rhoncus. Maecenas id ultricies enim. Fusce sagittis quam vehicula aliquam tempor. Nullam eu dolor id tellus varius accumsan sit amet nec arcu. Suspendisse dignissim dapibus eros ac mollis. Donec id iaculis dolor. Donec sodales vestibulum tellus, nec tempus dolor convallis ut. Ut venenatis dictum lacus at blandit. In finibus bibendum arcu sed consectetur. Phasellus aliquet enim eu ipsum hendrerit, nec efficitur massa pharetra. Vivamus nec ultricies eros.

Etiam commodo felis blandit, semper lacus eu, rhoncus justo. Aliquam nec iaculis urna, sed efficitur magna. Cras tincidunt pretium ipsum, vitae pulvinar elit maximus vitae. Sed nibh purus, feugiat eu est et, consectetur varius nisl. Vivamus vel quam semper, suscipit magna vitae, elementum augue. Mauris semper pretium magna, nec posuere libero efficitur eget. Proin laoreet lacus id ipsum porta efficitur. Nunc suscipit vestibulum porttitor. Suspendisse potenti. Suspendisse massa nulla, gravida eu erat id, gravida rhoncus ipsum. Aliquam massa lacus, convallis in purus sed, commodo scelerisque risus. Proin vehicula felis sed sapien cursus pharetra.

Cras eleifend ex at enim viverra egestas et in diam. Praesent ullamcorper aliquam turpis, in suscipit elit. Etiam feugiat congue arcu, ac gravida purus sagittis sit amet. Aliquam faucibus libero nisl. Cras tristique sodales enim, sit amet aliquet nisl tristique a. Morbi mattis mauris sit amet urna eleifend viverra. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc sit amet quam venenatis, sodales dolor et, scelerisque elit. In vestibulum aliquet dui, ac malesuada ante dapibus at. Nunc nunc felis, venenatis lacinia sapien vitae, pulvinar scelerisque felis. Duis eget tincidunt dolor. Morbi id urna in nulla hendrerit commodo non a elit. Nullam bibendum vulputate dolor. Curabitur vel tellus nec augue interdum feugiat sit amet vel dui. Maecenas sit amet sem id elit sagittis tristique a eget augue.

Donec ut justo scelerisque, ullamcorper leo eget, consectetur nulla. Proin a molestie risus. Vestibulum dapibus volutpat porttitor. Aliquam ut placerat est. Phasellus vitae metus elementum lorem pharetra dictum ut auctor magna. Pellentesque vitae ipsum in tortor convallis luctus. Donec ut tortor nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ullamcorper consequat tortor eu dapibus. Vestibulum sapien ex, lacinia non risus ut, commodo vehicula velit. Curabitur egestas at nunc vitae posuere. Morbi malesuada, dui nec mattis lacinia, magna diam ultrices nulla, vitae vehicula lorem ipsum a dolor. Donec feugiat arcu ornare quam imperdiet aliquet. Maecenas volutpat risus eget nibh ultrices tincidunt. Aliquam imperdiet mollis euismod.

Cras in orci consequat, ultricies nisl nec, ultrices massa. Mauris et sapien sed arcu pharetra tempor. In eu sagittis mi. Sed commodo velit vitae velit feugiat, ut dignissim lacus sollicitudin. In porta tempus eleifend. Nulla facilisi. Aenean sit amet eros sed lorem venenatis eleifend eu sed sem. Nullam et imperdiet purus, in aliquet ex. Nunc dapibus, dui id cursus pharetra, arcu libero egestas erat, ac tincidunt justo massa sed sem. Phasellus non placerat enim, sed vestibulum lorem. Suspendisse ac mattis elit.
</div>
@endsection
@section("body-end")
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.13.1/TweenLite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.4/easing/EasePack.min.js"></script>
<script src="/static/js/animated.js"></script>
@endsection