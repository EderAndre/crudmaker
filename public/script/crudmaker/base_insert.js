
//JavaScript Document
$().ready(function(){
$('#CrudInsert .zend_form').append($('#description'));
$('#CrudInsert .zend_form').append($('#CrudInsertSend'));
$('#description').on('change','select.select_crud',function(){ 
listables=['select','multiselect','checkbox','radiobutton'];
if(listables.indexOf($(this).val())>-1){
$(this).next('input').removeClass('invisible');
}else{
$(this).next('input').addClass('invisible');
}
});	

$('#table_name').after("&nbsp;<label id='table_exists'></label>");
$('#table_exists').after("&nbsp;&nbsp;<button class='btn btn-success invisible' id='estrutura'>Detectar Estrutura</button><br><code id='resultado'></code>");

$('#table_exists').after("<br><code id='resultadojson'></code>");


$('#data_ex').change(function(){ alert($('#data_ex').val());});
$('#table_name').keyup(function(){ exists();});
$('#name').keyup(function(){ 
$(this).val($(this).val().replace(/[^a-z]/g,''));
existsfeature();});
$('#connection').change(function(){ exists();});

$('#CrudInsertSend').click(function (){
	arr={};
	arr.generalConfigs={};
	arr.elements=[];
	arr.generalConfigs.primaryKey=$('#primary_key_temp').val();
	arr.generalConfigs.searcheable=$('#field_searcheable').val();
	arr.generalConfigs.connectionId=$('#connection').val();
	arr.generalConfigs.tableName=$('#table_name').val();
	$("input[name^='desc.lineCounter']").each(function(){
		fieldNumber=$(this).val();
		var line={};
		$("input[name^='desc.field"+fieldNumber+"'],select[name^='desc.field"+fieldNumber+"']").each(function(){
			val=($(this).attr('name')).substring(13);
			value=$(this).attr('type')=='checkbox'?($(this).is(':checked')):$(this).val();
			line[val]=value;

		});
		arr.elements.push(line);
	});
//$('#resultadojson').html(JSON.stringify(arr));
$('#primary_key').val($('#primary_key_temp').val());
$('#descriptor').val(JSON.stringify(arr));
$('form:first').submit();



});	

$('#estrutura').click(function detectar(e){
e.preventDefault();
	con=$('#connection').val();
	tab=$('#table_name').val();
	$.ajax({
	url:"../crud/fields/id/"+con+"/table/"+tab,

}).done(function(data){

//$('#resultado').html(data);
count=1;

description=
"<table class='table'>"
+"<tr>"+
"<td>CAMPO</td>"
+"<td>RÓTULO(Sugerido)</td>"
+"<td>TIPO(Sugerido)</td>"
+"<td>TIPO(Banco)</td>"
+"<td>Manipular pelo CRUD?</td>"
+"<td>Ver na lista base</td>"
+"<td>Requerido</td>"
+"<td>INFO</td>"
+"</tr>";
fields='';
isPrimary="<span class='badge badge-danger'> Tabela NÃO possui chave primária Definida, CRUD não pode ser criado!!</span>";
$.each($.parseJSON(data),function(i,item){  

if(!item.NULLABLE){nullable="&nbsp;<span class='badge badge-danger'>Não NULO</span>&nbsp;";
sugerirManipulacao='checked';
}else{
sugerirManipulacao='';
nullable="";}
if(!item.DEFAULT){default1="&nbsp;<span class='badge badge-danger'>Sem valor padrão</span>&nbsp;";}else{default1="";}
if(item.IDENTITY){idt1="&nbsp;<span class='badge badge-info'>Auto-Incremento</span>&nbsp;";}else{idt1="";}
txt="_00"+count;
txt=txt.substring(txt.length-2,txt.length);
if(item.PRIMARY){
isPrimary="<span class='badge badge-success'>Chave Primária detectada:<b>"+item.COLUMN_NAME+"</b></span><input type='hidden' name='primary_key_temp' id='primary_key_temp' value='"+item.COLUMN_NAME+"'/>"+fields;
isPrimaryInfo="&nbsp;<span title='Chave Primária' class='fa fa-key badge badge-warning'> </span>";
}else{

isPrimaryInfo="";
} 

fields+='<option value="'+item.COLUMN_NAME+'" >'+item.COLUMN_NAME+'</option>'; 
description+="<tr>"
+"<td><input type='hidden' name='desc.lineCounter"+txt+"' id='desc.lineCounter"+txt+"' value='"+txt+"'> <input type='text'name='desc.field"+txt+"_name' id='desc.field"+txt+"_name' value='"+item.COLUMN_NAME+"' readonly='true'></td>"
+"<td><input type='text' name='desc.field"+txt+"_label' id='desc.field"+txt+"_label' value='"+fieldlize(item.COLUMN_NAME)+"'></td>"

+"<td>"+suggestTypeSelected(item.DATA_TYPE,'desc.field'+txt+'_type')+"<input type='text' name='desc.field"+txt+"_array' id='desc.field"+txt+"_array' placeholder='Separe com vírgulas(,) ' class='invisible' /></td>"
+"<td><span class='badge badge-info' style='min-width:100px;'>"+item.DATA_TYPE+"</span></td>"

+"<td><input type='checkbox' name='desc.field"+txt+"_editable' id='desc.field"+txt+"_editable' "+sugerirManipulacao+"></td>"
+"<td><input type='checkbox' name='desc.field"+txt+"_listable' id='desc.field"+txt+"_listable' ></td>"
+"<td><input type='checkbox' name='desc.field"+txt+"_required' id='desc.field"+txt+"_required' "+sugerirManipulacao+"></td>"

+"<td>"+isPrimaryInfo+idt1+nullable+default1+"</td>"
+"</tr>";


count++;
                 });
description+="</table>";

generalConfigs=
"<br>"+isPrimary+
"<label>Escolha um campo para busca: </label><select name='field_searcheable' id='field_searcheable' >"+fields+"</select>"
;

$('#description').html(generalConfigs+ description); 
$('#CrudInsertSend').removeClass('invisible');

}).fail(function(){alert('Falhou!')});	
$('#CrudInsertSend').addClass('invisible');
	
});


});

function existsfeature(){

	name=$('#name').val();
$.ajax({
	url:"../crud/existsfeature/name/"+name,

}).done(function(data2){
if(name.length<3){
$('#alertExistsFeature').addClass('invisible');
$('#CrudInsertSend').addClass('invisible');
}else if($.parseJSON(data2).result=='true' && name.length>2){

$('#alertExistsFeature').addClass('invisible');


}
else{
$('#alertExistsFeature').removeClass('invisible');
$('#CrudInsertSend').addClass('invisible');
}
}).fail(function(){$('#table_exists').html('Erro de conexão')});

}

function exists(){

	con=$('#connection').val();
	tab=$('#table_name').val();
	name=$('#name').val();
$.ajax({
	url:"../crud/tbexists/id/"+con+"/table/"+tab,

}).done(function(data){
dataP=$.parseJSON(data)

if(dataP.result==true && name.length>2){
console.log(dataP);
$('#table_exists').html("<span class='badge badge-info'> "+dataP.messages+"</span>");
$('#estrutura').removeClass('invisible');
//$('#CrudInsertSend').removeClass('invisible');


}else{
$('#table_exists').html("<span class='badge badge-danger'> Erro: "+dataP.messages+"</span>");
$('#estrutura').addClass('invisible');
$('#CrudInsertSend').addClass('invisible');
$('#description').html('');
}

}).fail(function(){$('#table_exists').html('Erro de conexão')});

}
function fieldlize(str){
str=str.split('_').join(' ').toLowerCase();
str=str.charAt(0).toUpperCase()+str.slice(1);
return str+': ';
}
function suggestTypeSelected(type, nameField){
		text=number=date=datetime=boolean=hidden=double=select=multiselect=checkbox=radiobutton="";
		switch(type){
			case 'varchar': 
			case 'nvarchar':	
			case 'text':
			
			text='selected';
			break;

			case 'int': 
			case 'bigint':
			case 'decimal':

			number='selected';
			break;


			case 'date':

			date='selected';
			break;

			case 'datetime' :
			case 'timestamp':

			datetime='selected';
			break;


			case 'tinyint': 
			case 'boolean':
			case 'bit':

			boolean='selected';
			break;

			case 'double': 
			case 'float':
			case 'decimal':

			double='selected';
			break;
			
			case 'select': 
		
			select='selected';
			break;

			case 'multiselect': 
		
			multiselect='selected';
			break;
			
			case 'checkbox': 
		
			checkbox='selected';
			break;

			case 'radiobutton': 
		
			radiobutton='selected';
			break;

			default:
			hidden='selected';


			}


	ret="<select class='select_crud' id='[__NAME_FIELD__]' name='[__NAME_FIELD__]'>"
		+"<option value='text'"+text+">Texto</option>"
		+"<option value='number' "+number+">Numero Inteiro(HTML5)</option>"
		+"<option value='double' "+double+">Numero Decimal(HTML5)</option>"
		+"<option value='date' "+date+">Data(HTML5)</option>"
		+"<option value='datetime' "+datetime+">Data/Hora(HTML5)</option>"
		+"<option value='boolean' "+boolean+">Sim/Não</option>"
		+"<option value='select' "+select+">Select</option>"
		+"<option value='multiselect' "+multiselect+">MultiSelect</option>"
		+"<option value='checkbox' "+checkbox+">CheckBox</option>"
		+"<option value='radiobutton' "+radiobutton+">RadioButton</option>"
		+"<option value='hidden' "+hidden+">Oculto</option>"
		+"</select>";
	ret=ret.split('[__NAME_FIELD__]').join(nameField);


	return ret;
}

