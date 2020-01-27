const URL = "http://localhost:50080/DB_Test/Player";

window.onload = () =>
{		
	RequestAsync("GET",URL,GetAllName);

	let InsertButton = document.getElementById("Insert_button");
	let NameBox = document.getElementById("NameBox");
	InsertButton.onclick = () => RequestAsync("POST", URL + "/" + NameBox.value, InitNameBox);

	let GetBotton = document.getElementById("Get_button");
	GetBotton.onclick = () => RequestAsync("GET",URL,GetAllName);

	let UpedateButton = document.getElementById("Update_button");
	UpedateButton.onclick = () => RequestAsync("PUT", URL + "/" + NameBox.value + "/" + GetSelectedName(), InitNameBox);

	let DeleteButton = document.getElementById("Delete_button");
	DeleteButton.onclick = () => RequestAsync("DELETE", URL + "/" + GetSelectedName(), InitNameBox);
};

const GetSelectedName = () =>
{
	const playerNameList = document.getElementById("AllMemberNameList");
	const selectedName = playerNameList.value;
	return selectedName;
};

const InitNameBox = () =>
{	
	let AddNameBox = document.getElementById("NameBox");
	AddNameBox.value = "";
	RequestAsync("GET",URL,GetAllName);
};

const GetAllName = (response) =>
{	
	let playerNameList = document.getElementById("AllMemberNameList");
	while(playerNameList.firstChild)
	{
		playerNameList.removeChild(playerNameList.firstChild);
	}

	const items = JSON.parse(response);
	for(const index in items)
	{
		let child = document.createElement("option");	
		child.value = child.innerHTML = items[index].name;
		playerNameList.appendChild(child);
	}
};

const RequestAsync = (openMethodName, url, OnSuccessRequest) => 
{
	let xhr  = new XMLHttpRequest();
	xhr.open(openMethodName, url, true);

	xhr.onload = () =>
	{
		if (xhr.readyState == 4 && xhr.status == "200") 
		{			
			OnSuccessRequest(xhr.responseText);
		}
		else 
		{
			console.error(xhr.responseText);
		}
	};

	xhr.send(null);
};
