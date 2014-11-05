/**
 * Hides all other input fields, for widgets settings form
 * 
 */
function qbdevby_widgets_hideAllOtherInputFields_toggle(id, toggle){
	element = document.getElementById(id);
	if(!element)
		return;
	widget_content = document.getElementById(id).parentNode.parentNode;
	widget_content_children = widget_content.children;
	for(var i=0; i<widget_content_children.length; i++){
		widget_content_grandchildren = widget_content_children[i].children;
		for(var j=0; j<widget_content_grandchildren.length; j++){
			if(!(widget_content_grandchildren[j].id===id || widget_content_grandchildren[j].getAttribute('for')===id)){
				if(toggle){
					widget_content_grandchildren[j].style.display = 'block';
				} else{
					widget_content_grandchildren[j].style.display = 'none';
				}
			}
		}
	}
}