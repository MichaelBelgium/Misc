stock IsVehicleUpsideDown(vehicleid)
{
	new Float:quat_w,Float:quat_x,Float:quat_y,Float:quat_z;
	GetVehicleRotationQuat(vehicleid,quat_w,quat_x,quat_y,quat_z);
	new Float:y = atan2(2*((quat_y*quat_z)+(quat_w*quat_x)),(quat_w*quat_w)-(quat_x*quat_x)-(quat_y*quat_y)+(quat_z*quat_z));
	return (y > 90 || y < -90);
}

stock GetPlayerID(name[])
{
	for(new i = 0, j = GetMaxPlayers(); i < j; i++)
	{
		if(!IsPlayerConnected(i)) continue;
		if(!strcmp(PlayerName(i),name)) return i;
	}
	return INVALID_PLAYER_ID;
}
