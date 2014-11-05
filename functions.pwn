stock IsVehicleUpsideDown(vehicleid)
{
	new Float:quat_w,Float:quat_x,Float:quat_y,Float:quat_z;
	GetVehicleRotationQuat(vehicleid,quat_w,quat_x,quat_y,quat_z);
	new Float:y = atan2(2*((quat_y*quat_z)+(quat_w*quat_x)),(quat_w*quat_w)-(quat_x*quat_x)-(quat_y*quat_y)+(quat_z*quat_z));
	return (y > 90 || y < -90);
}

stock GetPlayerID(name[])
{
	new pName[MAX_PLAYER_NAME];
	for(new i = 0, j = GetMaxPlayers(); i < j; i++)
	{
		if(!IsPlayerConnected(i)) continue;
		GetPlayerName(i,pName,sizeof(pName));
		if(!strcmp(pName,name)) return i;
	}
	return INVALID_PLAYER_ID;
}
