const btn_add = document.querySelector('#add-other');



const agregar_capitulo = ()=>{

	/******************/
	// opteniendo id de la serie y de la temporada
	const info = document.querySelectorAll('input.capitulo-input');

	const serie_id = info[0].value;
	const season_id = info[1].value;
	const token = info[2].value;


	// formulario de nuevo capitulo (para agregar el nuevo div con los input)
	const formulario = document.querySelector('#form-new-capitulo');

	// div de nuevo capitulo (principal: para saber el numero de capitulos a agregar)
	const nuevo_capitulo = document.querySelectorAll('div.new-capitulo');

	/******************/

	// creando nuevo div
	const div = document.createElement('div');

	//agregandole clase 
	div.setAttribute('class', 'new-capitulo mt-4');


	// type
	// class
	// name
	// value ?
	// placeholder ?

	const nuevo_input = (type, classname, name, value, placeholder) =>{

		//cuenta de capitulos ya existentes para agregar//
		// variable para saber el numero de div (capitulos para crear)
		
		let i = nuevo_capitulo.length;

		let tipo = type === true ? 'text' : 'hidden';
		let clase = classname === true ? 'form-control capitulo-input my-1' : 'capitulo-input';

		const input = document.createElement('input');
		input.setAttribute('type', tipo);
		input.setAttribute('class', clase);
		
		input.setAttribute('name', 'capitulo['+ i +']['+name+']');
	
		value ? input.setAttribute('value', value) : '' ;
		placeholder? input.setAttribute('placeholder', placeholder) : '';
		
		div.appendChild(input);

	}


	nuevo_input(false, false, 'serie_id', serie_id, false);
	nuevo_input(false, false, 'season_id', season_id, false);
	nuevo_input(false, false, 'token', token, false);
	nuevo_input(true, true, 'titulo', false, 'titulo del capitulo');
	nuevo_input(true, true, 'chapter_num', false, 'numero de capitulo');
	nuevo_input(true, true, 'link', false, 'link');


	// agregando el nuevo div al formulario
	formulario.appendChild(div);

}

// agregar_capitulo();
if(btn_add){
	btn_add.addEventListener("click", agregar_capitulo);
}


const mix_remove_input = (key) => {
	const element = document.querySelector('#mix'+key);

	element.remove();
}




