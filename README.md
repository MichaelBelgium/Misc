Misc
====

Small and maybe useful things for a SA:MP Server

<h1>OnPlayerVehicleHealthChange (OPVH.pwn)</h1>

```PAWN
public OnPlayerVehicleHealthChange(playerid, vehicleid, Float:newhealth, Float:oldhealth);
```

<h2>Example</h2>
```PAWN
public OnPlayerVehicleHealthChange(playerid, vehicleid, Float:newhealth, Float:oldhealth)
{
    if(newhealth > oldhealth) BanEx(playerid,"Healthhack");
    return 1;
}
```

<h1>Useful functions (functions.pwn) </h1>
Or not useful ?
```PAWN
native GetPlayerID(name[])
native stock IsVehicleUpsideDown(vehicleid)
```

<h1>Anti-Pausing, Anti-Tab, Anti-esc, ... (anti_pause.inc)</h1>

```PAWN
public OnPlayerPause(playerid);
public OnPlayerUnPause(playerid);

native IsPlayerPaused(playerid);
```

<h2>Example</h2>

```PAWN
#include <Anti_Pause>
 
public OnPlayerPause(playerid)
{
    new name[MAX_PLAYER_NAME], string[64];
    GetPlayerName(playerid, name, sizeof(name));
    format(string, sizeof(string), "%s pressed esc.",name);
    SendClientMessageToAll(COLOR_RED, string);
    return 1;
}
 
public OnPlayerUnPause(playerid)
{
    new name[MAX_PLAYER_NAME], string[64];
    GetPlayerName(playerid, name, sizeof(name));
    format(string, sizeof(string), "%s unpaused.",name);
    SendClientMessageToAll(COLOR_RED, string);
    return 1;
}
```

<h2>Anti_Pause2.inc</h2>

If you have issues with errors or you just don't wanna use y_hooks for anti_pause.inc then use <b>anti_pause2.inc</b>
Do note you have to add these functions to the right callbacks:
```PAWN
native P_OnPlayerConnect(playerid);
native P_OnPlayerUpdate(playerid);
native P_OnPlayerRequestClass(playerid);
native P_OnPlayerDisconnect(playerid);
native P_OnPlayerSpawn(playerid);
```

<h1>mta_mapmover.php</h1>

This is a webpage where u can mass move a mta map. Select a .map file, fill in the offsets and it will change all the positions from the original map to +offset. Afterwards you get the converted .map file back as download.

Demo: <a href="http://ucp.lm-dm.net/mapmover.php">Here</a>
