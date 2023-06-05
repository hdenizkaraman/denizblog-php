// JavaScript Document
var url = "http://localhost/DenizKaraman";

function sendmessage()
{
	var value = $("#aboutForm").serialize();
	$.ajax({
		
		type : "POST",
		url : url + "/includes/sendmessage.php",
		data : value,
		success : function(result)
		{
			if($.trim(result) == "empty")
				{
					Swal.fire("Bir Hata Yaklaşıyor Efendim...","Lütfen Boş Alan Bırakma","error");
				}
			else if($.trim(result) == "format")
				{
					Swal.fire("Bir Hata Yaklaşıyor Efendim...","E-postanda bir yanlışlık seziyorum, Kontrol etmeye ne dersin?","error");
				}			
			else if($.trim(result) == "syerror")
				{
					Swal.fire("Ben Hata Yapmıyorum, Ben Hatanın Ta Kendisiyim!","Bunun İçin Üzgünüm Ama Sistemimde Bir Hata Var. Benle Instagramdan İletişime Geçebilirsin.","error");
				}
			else if($.trim(result) == "successful")
				{
					Swal.fire("Hmm, Temiz İş!","Mesajın Özel Taşıyıcılarla Sahibine İletildi, Artık Rahatça Uyuyabilirsin.","success");
					$("input[name=name]").val('');
					$("input[name=email]").val('');
					$("select[name=selection]").val('');
					$("textarea[name=message]").val('');
				}
		}		
	});
}

function sendcom()
{
	var value = $("#comForm").serialize();
	$.ajax({
		
		type: "POST",
		url : url + "/includes/sendcomment.php",
		data : value,
		success : function(result)
		{
		
			if($.trim(result) == "empty")
				{
					Swal.fire("Bir Hata Yaklaşıyor Efendim...","Lütfen Boş Alan Bırakma","error");
				}
			else if($.trim(result) == "format")
				{
					Swal.fire("Bir Hata Yaklaşıyor Efendim...","E-postanda bir yanlışlık seziyorum, Kontrol etmeye ne dersin?","error");
				}			
			else if($.trim(result) == "syerror")
				{
					Swal.fire("Ben Hata Yapmıyorum, Ben Hatanın Ta Kendisiyim!","Bunun İçin Üzgünüm Ama Sistemimde Bir Hata Var. Benle Instagramdan İletişime Geçebilirsin.","error");
				}
			else if($.trim(result) == "successful")
				{
					Swal.fire("Hmm, Temiz İş!","Yorumun Başarıyla Gönderildi! Deniz Bey Tarafından Onaylandığında Görülecektir.","success");
					$("input[name=comName]").val('');
					$("input[name=comEmail]").val('');
					$("input[name=comWebsite]").val('');
					$("textarea[name=comText]").val('');
				}
			
		}
	});
}

function mailsub()
{
	var value = $("#mailsubform").serialize();
	$.ajax({
		
		type: "POST",
		url : url + "/includes/mailsub.php",
		data : value,
		success : function(result)
		{
		
			if($.trim(result) == "empty")
				{
					Swal.fire("Bir Hata Yaklaşıyor Efendim...","Lütfen Boş Alan Bırakma","error");
				}
			else if($.trim(result) == "format")
				{
					Swal.fire("Bir Hata Yaklaşıyor Efendim...","E-postanda bir yanlışlık seziyorum, Kontrol etmeye ne dersin?","error");
				}			
			else if($.trim(result) == "syerror")
				{
					Swal.fire("Ben Hata Yapmıyorum, Ben Hatanın Ta Kendisiyim!","Bunun İçin Üzgünüm Ama Sistemimde Bir Hata Var. Benle Instagramdan İletişime Geçebilirsin.","error");
				}
			else if($.trim(result) == "already")
				{
					Swal.fire("Hmm Seni Daha Önce de Görmüştüm!","Aynı Eposta Adresiyle Zaten Abone olunmuş.","error");
				}
			else if($.trim(result) == "successful")
				{
					Swal.fire("Hmm, Temiz İş!","Artık yazdığım her yazı ilk senin mail kutuna gelecek!.","success");
					$("input[name=subMail]").val('');
				}
			
		}
	});
}












