function setHeaderEvents()
{
	var brandTxt = document.getElementById("brand-text-part");
	setTimeout(function(){
		brandTxt.classList.add("spell-full");
		setTimeout(function(){
			brandTxt.classList.remove("spell-full");
		},3000);
	},1000);
}
function getHeaderHeight()
{
	header = document.getElementById("header");
	
	return header.getBoundingClientRect().height;
}
