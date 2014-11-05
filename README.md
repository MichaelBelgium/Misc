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
    if(oldhealth > newhealth) BanEx(playerid,"Healthhack");
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
public OnPlayerPause(playerid)
public OnPlayerUnPause(playerid)
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
