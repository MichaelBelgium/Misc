//On top
new Float:VehicleHealth[MAX_VEHICLES][2]; // [0] = new, [1] = old


public OnPlayerUpdate(playerid)
{
	new vehicleid = GetPlayerVehicleID(playerid);
	GetVehicleHealth(vehicleid, VehicleHealth[vehicleid][0]);
	if(VehicleHealth[vehicleid][0] != VehicleHealth[vehicleid][1])
	{
	    CallLocalFunction("OnPlayerVehicleHealthChange", "iiff", playerid, vehicleid, VehicleHealth[vehicleid][0],VehicleHealth[vehicleid][1]);
	    VehicleHealth[vehicleid][1] = VehicleHealth[vehicleid][0];
	}
	return 1;
}
 
forward OnPlayerVehicleHealthChange(playerid, vehicleid, Float:newhealth, Float:oldhealth);
public OnPlayerVehicleHealthChange(playerid, vehicleid, Float:newhealth, Float:oldhealth)
{
    new string[128],pName[MAX_PLAYER_NAME];
    GetPlayerName(playerid,pName,MAX_PLAYER_NAME);
    format(string,sizeof string,"OnPlayerVehicleHealthChange detected for %s (%d)",pName,playerid);
    SendClientMessage(playerid,COLOR_GREY,string);
    return 1;
}
