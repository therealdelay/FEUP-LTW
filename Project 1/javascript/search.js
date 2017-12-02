
// SELECTORS
let listInf = document.querySelectorAll(".list");
let titleSearch = document.querySelector("#search input[name=search_title");
let prioritySearch = document.querySelector("#search select");
let categoriesSearch = document.querySelector("#search input[name=category");


String.prototype.replaceAll = function(strReplace, strWith) {
    var esc = strReplace.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    var reg = new RegExp(esc, 'ig');
    return this.replace(reg, strWith);
};

function filterTitle(list){
	if(titleSearch.value){
		let title = list.childNodes[1].innerHTML;
		filter = title.replaceAll(titleSearch.value,"");
		if(title != filter)
			return true;
		else
			return false;
	}
	
	return true;
}

function filterPriority(list){
	if(prioritySearch.value){
		
		let priority = list.classList[list.classList.length-1];
	
		if(priority == prioritySearch.value)
			return true;
		else
			return false;
	}
	
	return true;
}

function getListCategories(list){
	categories = [];
	categoryNodes = list.childNodes[5].childNodes;
	for(let i = 1; i < categoryNodes.length; i+=2){
		categories.push(categoryNodes[i].childNodes[1].innerHTML);
	}
	return categories;
}

function filterCategories(list){
	if(categoriesSearch.value){
		
		let categories = getListCategories(list);
		let filterCategories = [categoriesSearch.value];
		
		filteredCategories = categories.filter((n) => filterCategories.includes(n));
	
		if(filteredCategories.length > 0)
			return true;
		else
			return false;
	}
	
	return true;
}

function filterSearch(){
	for(let i = 0; i < listInf.length; i++){
		if(filterTitle(listInf[i]) && filterPriority(listInf[i]) && filterCategories(listInf[i]))
			listInf[i].parentNode.style.display = "";
		else
			listInf[i].parentNode.style.display = "none";
	}

}

titleSearch.addEventListener("keyup", filterSearch);
prioritySearch.addEventListener("change", filterSearch);
categoriesSearch.addEventListener("keyup", filterSearch);