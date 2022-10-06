function findID()
{
	var form = document.FID;

	if(isFrmEmpty(form.name, "이름을 입력해 주십시오"))	return;
	if(!isJumin(form.jumin1, form.jumin2))	return;

	form.submit();
}

function findPwd()
{
	var form = document.FPWD;

	if(isFrmEmpty(form.name, "이름을 입력해 주십시오"))	return;
	if(!isJumin(form.jumin1, form.jumin2))	return;

	form.submit();
}