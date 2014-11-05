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
