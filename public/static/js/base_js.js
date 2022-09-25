var sideBar;
var sideContent;
var topbar;
var menuIcon;
var sideBackground;
function setMenu()
{
	menuIcon = document.getElementById("menu-icon");
	sideBar = document.getElementById("sidebar");
	sideBackground = document.getElementById("side-background");
	sideContent = document.getElementById("side-content");
	var sideClose = document.getElementById("menu-close");
	
	menuIcon.onclick = function()
	{
	    openMenu();
	}
	
	sideBackground.onclick = function()
	{
		closeMenu();
	}
	
	sideClose.onclick = function()
	{
		closeMenu();
	}
	
}
function openMenu()
{
    sideBar.style.opacity = "1";
	sideBar.style.zIndex = 10;
	sideContent.style.right = "0px";
	sideBackground.style.opacity = "0.5";
}
function closeMenu()
{
    sideBar.style.opacity = "0";
	sideBar.style.zIndex = -1;
	sideContent.style.right = "-100%";
	sideBackground.style.opacity = "0";
}
function setTopbar()
{
	topbar = document.getElementById('topbar');
	/*var container = document.getElementById('container');
	
	window.onscroll = function(e)
	{
		try{
			header = getHeaderHeight();
			if(header != null){
			if(window.scrollY >= header)
			{
				
			}
			else{
				topbar.classList.remove("topbar-scrolled");
				document.getElementById("topbar-brand").style.opacity="0";
			}
			}
		}catch(e){
		if(window.scrollY >= 75) 
		{
			
		}
		else{
			
		}
		}
	}*/
}
function showTopBar()
{
    topbar.classList.add("topbar-scrolled");
    //document.getElementById("topbar-brand").style.opacity="1";
}
function hideTopBar()
{
    topbar.classList.remove("topbar-scrolled");
   // document.getElementById("topbar-brand").style.opacity="0";
}
function setUp()
{
	setMenu();
	setTopbar();
}
function showMenuIcon()
{
    menuIcon.style.opacity = "1";
}
function hideMenuIcon(){menuIcon.style.opacity = "0"}