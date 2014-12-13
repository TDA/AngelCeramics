$(document).ready(function(e) {
    $('#editor').hide();
	$('.search-results').css({'height':'0px', 'opacity':'0'});
	$('.quality-results').css({'height':'0px', 'opacity':'0'});
	$('.register').css({'height':'0px', 'opacity':'0'});
	$('.regtitle').css({'height':'0px', 'opacity':'0'});
	
	
	$('nav.custonav li a').hover(function() {
	$('#nav-blob').stop().animate({width: $(this).width() + 10, left: $(this).position().left},{duration: 'slow', queue: false},'linear');
	},function(){
	$('#nav-blob').stop().animate({left:$('nav.custonav li a.current').position().left,width:$('nav.custonav li a.current').width() + 10},{duration: 'slow', queue: 		false});
	});

	
	
	
	$('.success').animate({'opacity':'0','height':'0'},2500);
		$('.remove').click(function(){
			//var confirm=confirm("Is it ok to delete this record?");
			var prodId = $(this).parent().siblings('.id').text();
    		var prodName = $(this).parent().siblings('.pname').text();
			var dec=confirm('Is it ok to delete this record?'+prodId+' '+prodName);
		if(dec==true){
		$.ajax({
			'method':'post',
			'url':'removeprod.php',
			'data':{id:$(this).attr('value')}
			
			}).done(function(res){
					if(res==0)
					{
						alert('It seems you are trying to delete a non-existing product. Please use EDIT to change an existing product ');
					}
					else if(res==1)
					{
						alert('Ok, we are cool, everythings done.');
					}
					updatePage();
					
			});
		}
		return false;
		});
			
		$('#search').click(function(){
			var data={
			 name : $('#name').val(),
			 modelno : $('#modelno').val(),
			 size : $('#size').val(),
			 type : $('#type').val(),
			 make : $('#make').val(),
			 colour : $('#colour').val(),
			 date : $('#date').val(),
			 }
			var count=0;
			for(ppt in data)
			{	
				if(!data[ppt]=='')
				count++;
			}
			
			if(count==0)
			{
			alert("Enter atleast one search term");
			return false;
			}
			else{
			var pstart = $('#pricestart').val(), pend = $('#priceend').val();
			data['pstart']=pstart;
			data['pend']=pend;
			
			$.ajax({
			'method':'post',
			'url':'search.php?num=1',
			'data':data
			}).done(function(res){
					/*var nores=res.split(',')[2];
					alert(nores);*/
					if(res!=21){
				
					var no_pages=res.split(',')[1];
					res=res.split(',')[0];
					$('.search-results').animate({'height':'auto','opacity':'1'}).addClass('exportable-table');
					$('.search-results tbody').html(res);
					$('.search-results tbody tr:odd,.search-results thead tr').addClass('even');
					$('#pagination').html('Page Links:');
					for(i=1;i<=no_pages;i++)
					{
						$('#pagination').append('<a href="">'+i+'</a>');
					}
					$('#pagination a:first-child').addClass('activepage');
					$('#pagination a').click(function(){
						var no=$(this).text();
						$('.activepage').removeClass('activepage');
						$(this).addClass('activepage');
						var url='search.php?num='+no;
						$.ajax({
							'method':'post',
							'url':url,
							'data':data
							}).done(function(res){
								/*var nores=res.split(',')[2];
								alert(nores);
								*/
									res=res.split(',')[0];
									$('.search-results tbody').html(res);
									$('.search-results tbody tr:odd,.search-results thead tr').addClass('even');
					
							});
						
						return false;
			
					});
					}
				else{
					alert('Oops, Not found, Change the restrictions to get more samples');
				}
					
			});
			}
		});
		
		$('#qualcheck').click(function(){
			var data={
			 name : $('#name').val(),
			 modelno : $('#modelno').val(),
			 size : $('#size').val(),
			 type : $('#type').val(),
			 make : $('#make').val(),
			 colour : $('#colour').val(),
			 date : $('#date').val(),
			 }
			 //alert(pstart+' '+pend);
			var count=0;
			for(ppt in data)
			{	
				if(!data[ppt]=='')
				count++;
			}
			
			if(count==0)
			{
			alert("Enter atleast one search term");
			return false;
			}
			else{
			var pstart = $('#pricestart').val(), pend = $('#priceend').val();
			data['pstart']=pstart;
			data['pend']=pend;
			$.ajax({
			'method':'post',
			'url':'searchone.php',
			'data':data
			}).done(function(res){
				if(res!=21){
				var result=res.split(',')[0];
				var img=res.split(',')[1];
				
				$('.quality-results').animate({'height':'auto','opacity':'1'}).addClass('exportable-table');
				if(img=='Images\/')
				img='Images\/nf.jpg';
				$('.quality-results tbody').html(result).append('<tr><th colspan=2>Quality Images</th></tr><tr><td colspan=2><img src='+img+'></td></tr>');
				var qty=$('td:contains("QTY")').next().text();
				var pcs=$('td:contains("PCS")').next().text();
				var availstock=qty*pcs;
				$('<tr><td class=bold>AVAILABLE STOCK (QTY*PCS)</td><td class=bold>'+availstock+'</td></tr>').insertAfter($('tr:has(td:contains("PCS"))'));
				
				$('.quality-results tbody tr:odd,.quality-results thead tr').addClass('even');
				}
				else{
					alert('Oops, Not found, Change the restrictions to get more samples');
				}
				});
			}
		});
		
		$('#checkstock').click(function(){
			var data={
			 name : $('#name').val(),
			 modelno : $('#modelno').val(),
			 size : $('#size').val(),
			 type : $('#type').val(),
			 make : $('#make').val(),
			 colour : $('#colour').val(),
			 date : $('#date').val(),
			 }
			var count=0;
			for(ppt in data)
			{	
				if(!data[ppt]=='')
				count++;
			}
			
			if(count==0)
			{
			alert("Enter atleast one search term");
			return false;
			}
			else{
			var pstart = $('#pricestart').val(), pend = $('#priceend').val();
			data['pstart']=pstart;
			data['pend']=pend;
			
			$.ajax({
			'method':'post',
			'url':'searchone.php',
			'data':data
			}).done(function(res){
				if(res!=21){
				
				var result=res.split(',')[0];
				
				$('.quality-results').animate({'height':'auto','opacity':'1'}).addClass('exportable-table');
				
				$('.quality-results tbody').html(result);
				var qty=$('td:contains("QTY")').next().text();
				var pcs=$('td:contains("PCS")').next().text();
				var availstock=qty*pcs;
				$('<tr><td class=bold>AVAILABLE STOCK (QTY*PCS)</td><td class=bold>'+availstock+'</td></tr>').insertAfter($('tr:has(td:contains("PCS"))'));
				$('.quality-results tbody tr:odd,.quality-results thead tr').addClass('even');
				}
				else{
					alert('Oops, Not found, Change the restrictions to get more samples');
				}
				
				});
			}
		});
		
		
			
		$('.edit').click(function(){
			var data={
			 pid : $(this).parent().siblings('.id').text(),
    		 name : $(this).parent().siblings('.name').text(),
			 price : $(this).parent().siblings('.price').text(),
			 modelno : $(this).parent().siblings('.modelno').text(),
			 size : $(this).parent().siblings('.size').text(),
			 stock : $(this).parent().siblings('.qty').text(),
			 type : $(this).parent().siblings('.type').text(),
			 make : $(this).parent().siblings('.make').text(),
			 colour : $(this).parent().siblings('.colour').text(),
			 date : $(this).parent().siblings('.date').text(),
			 pcs : $(this).parent().siblings('.pcs').text()
			}
			
			for(ppt in data)
			{
				$('#'+ppt+'').val(data[ppt]);
			}
			$('#editor').show('slow');
				
		return false;
		});
		
			
		
		$('table tr:odd').addClass('odd');
		$('table tr:even').addClass('even');
		if(GetURLParameter('mn'))
		{
			name=GetURLParameter('name');
			mn=GetURLParameter('mn');
			var data={
			 modelno:GetURLParameter('mn'),
			 stock:GetURLParameter('q'),
			 pcs:GetURLParameter('p'),
			 price:GetURLParameter('pr'),
			 colour:GetURLParameter('c'),
			 size:GetURLParameter('s')
			};
			
			
			
			var tr=$('tr:has(td[class="modelno"]:contains("'+mn+'"))');
			tr.focus().addClass('focused');
			setTimeout(function(){tr.find(".edit").click();
			setTimeout(function(){for(ppt in data)
			{
				$('#'+ppt+'').val(data[ppt]).css({'box-shadow':'0px 0px 4px rgba(0,144,255,0.8)'});
			}
			},100);
			},1200);
			
		}
		
		
		$('input[type=search]').attr({'autocomplete':'off'}).keyup(function(e){
			e.preventDefault();
			$('.searchhelper ul').html('');
			var self=this;
			var word=$(this).val();
			var field=$(this).attr('name');
			$.ajax({
			url:'searchhelp.php',
			method:'post',
			data:{'word':word,
				  'field':field}
			}).done(function(res){
				//alert(trim(res)+'end');	
				res=trim(res);
				words=res.split(',');
				$('.searchhelper').css({'width':$(self).width()+6,
					'left':$(self).position().left,
					'top':$(self).position().top + $(self).height()+6,
					'opacity':1,
					'display':'block'
				});
				
				var searchhelp=$('.searchhelper ul');
				var len=words.length;
				for(i=0;i<len;i++)
				{
					searchhelp.append('<li>'+words[i]+'</li>');
				}
				$('.searchhelper li').click(function(){
					var text=$(this).text();
					$(self).val(text);
					//alert(text+'a');
					//alert($(this).text());
					$(this).blur();
					});
				
				
				});
			//alert(field+' :'+word);
			
			
			});
			
			$('input[type=search]').blur(function(e){
				setTimeout(	function(){$('.searchhelper').html('<ul></ul>').css({'display':'none'})},300);
			});
			
			
			
			
			$('#gen').click(function(){
				$('.from').text('From : '+$('#from').val());
				$('.to').text('To : '+$('#to').val());
				$('.regtitle').animate({'height':'100%', 'opacity':'1'},1000);
	
			var data={
			 name : $('#name').val(),
			 modelno : $('#modelno').val(),
			 size : $('#size').val(),
			 type : $('#type').val(),
			 };
			var count=0;
			for(ppt in data)
			{	
				if(!data[ppt]=='')
				count++;
			}
			
			if(count==0)
			{
			alert("Enter atleast one search term");
			return false;
			}
			else{
			$.ajax({
			'method':'post',
			'url':'search.php?num=1',
			'data':data
			}).done(function(res){
					/*var nores=res.split(',')[2];
					alert(nores);*/
					if(res!=21){
				
					var no_pages=res.split(',')[1];
					res=res.split(',')[0];
					$('.register').animate({'height':'auto','opacity':'1'});
					$('.register tbody').html(res);
					$('.register tbody tr:odd,.register thead tr').addClass('even');
					$('#pagination').html('Page Links:');
					for(i=1;i<=no_pages;i++)
					{
						$('#pagination').append('<a href="">'+i+'</a>');
					}
					$('#pagination a:first-child').addClass('activepage');
					$('#pagination a').click(function(){
						var no=$(this).text();
						$('.activepage').removeClass('activepage');
						$(this).addClass('activepage');
						var url='search.php?num='+no;
						$.ajax({
							'method':'post',
							'url':url,
							'data':data
							}).done(function(res){
								/*var nores=res.split(',')[2];
								alert(nores);
								*/
									res=res.split(',')[0];
									$('.register tbody').html(res);
									$('.register tbody tr:odd,.register thead tr').addClass('even');
					
							});
						return false;
					});
					}
				else{
					alert('Oops, Not found, Change the restrictions to get more samples');
				}
			});
			}
		});
		
		
	$('#nav-blob').css({
	width: $('nav.custonav ul li a.current').width() +10,
	left: $('nav.custonav ul li a.current').position().left
	//top: $('nav.custonav ul li').position().top+$('nav.custonav ul li').height()
	});

			
			
		});
		
		
		
function updatePage(){
	window.location.reload();
}
			
function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
	}
}

function checkavail(id){
	var val=$('#'+id).val();
	if(val!=''){
	$.ajax({
		'url':'searchone.php',
		'method':'post',
		'data':{'modelno':val}
		
		}).done(function(res){
		if(res!=21){
		var resHTML='<html><head></head><body><table>';
		res=res.split(',')[0];
		resHTML+=res;
		resHTML+='</table></body></html>';
		
		var fields=
		{	 
			 name : $('#name'),
			 price : $('#price'),
			 size : $('#size'),
			 qty : $('#stock'),
			 type : $('#type'),
			 make : $('#make'),
			 colour : $('#colour'),
			 date : $('#date'),
			 pcs : $('#pcs')
		}
		for(ppt in fields)
		{
			fields[ppt].val(($(resHTML).find('.'+ppt ).next().text()));
			
		}
		//$('#stock').val($(resHTML).find('.qty').next().text());
		//alert(resHTML);
		var choice=confirm("Product Exists, Do you want to update the product?");
		if(choice==true)
		$('#add').click();
		else
		for(ppt in fields)
		{
			fields[ppt].attr({'readonly':'readonly'}).css({'background':'#eee'});
			$("option").not(":selected").attr("disabled", "disabled");

			fields[ppt].focus(function(e){
				e.preventDefault();});
		}
		
		}
		});
	}
	else{
		alert('Cant be empty');
		$('#'+id).focus();
	}
}

function updateothers(id){
	var val=$('#'+id).val();
	if(val!=''){
	$.ajax({
		'url':'populate.php',
		'method':'post',
		'data':{'modelno':val}
		
		}).done(function(res){
		if(res!=21)
		{	
			//alert(res);
		 var arr=res.split(',');
		 var keys=[],values=[];
		 for(i=0,j=0;i<arr.length;i+=2,j++){
		 keys[j]=arr[i];
		 }
		 
		 for(i=1,j=0;i<arr.length;i+=2,j++){
		 values[j]=arr[i];
		 }
		 
		 for(i=0;i<keys.length+1;i++){
			 $('#'+keys[i]).val(values[i]);
			 }
		 
		}
		});
	}
	else{
		alert('Cant be empty');
		$('#'+id).focus();
	}
	
}
function trim(text){
	text=text.split('\n')[0];
	text=text.split('\t')[0];
	//text=text.split(' ')[0];
	
	//text.replace('\t','');
	//text.replace('/\s+/g','');
	
	return text;
}


function write_to_excel() {
    str = "";
    var mytable = document.getElementById("tbExport");
    var rowCount = mytable.rows.length;
    var colCount = mytable.getElementsByTagName("tr")[0].getElementsByTagName("th").length;
    var ExcelApp = new ActiveXObject("Excel.Application");
    var ExcelSheet = new ActiveXObject("Excel.Sheet");
    //ExcelSheet.Application.Visible = true;
    for (var i = 0; i < rowCount; i++) {
        for (var j = 0; j < colCount; j++) {
            if (i == 0) {
                str = mytable.getElementsByTagName("tr")[i].getElementsByTagName("th")[j].innerText;
            }
            else {
                str = mytable.getElementsByTagName("tr")[i].getElementsByTagName("td")[j].innerText;
            }
            ExcelSheet.ActiveSheet.Cells(i + 1, j + 1).Value = str;
        }
    }
    ExcelSheet.autofit;
    ExcelSheet.Application.Visible = true;
    DisplayAlerts = true;
    CollectGarbage();
}

function export_xl(){
	var table=document.getElementsByClassName('exportable-table')[0];
	if(table!=undefined&&table.innerHTML!=undefined)
	{
		alert('exporting');
		window.open('data:application/vnd.ms-excel,'+'<html><body>'+encodeURIComponent(table.outerHTML)+'</body></html>');
	}
	else{
		alert('Please search first');
	}
	
	}