# IPMon

To store clients alive signals and view the log.

## showip.php
Called by client to store its signal and retrieve ip and/or time.

| Parameter   | Description                     |
|-------------|---------------------------------|
| n=Pico1     | Set 'Pico1' as client name      |
| data=x      | Store 'x' for a signal          |
| ret=ip      | return client's IP address      |
| ret=time    | return current server time      |
| ret=time-ip | return time and ip              |
| ret=json    | return a json of date, time, ip |
| tz=xxx/yyy  | timezone for reports            |

## list.php
To view the logs. A list is generated with the latest activity of each client, with hyperlinks to the actual log files.

## Time Zone
Both scripts' defualt timezone is set in the codes to Europe/Berlin. It can be set per request using "tz" parameter. Don't forget to replace the "/" with urlencoded version "%2F" when sending the request.

    https://MyDomain/ipmon/showip.php?n=DietPi1&tz=Asia%2FTehran
    

## Use Cases
I use it to:
### Store my devices IPs and their internet connectivity.
A periodic request is sent using a timer or cronjob, like:

    https://MyDomain/ipmon/showip.php?n=DietPi1

Then I can view the log, or send it to my ISP to prove them the disconnect times.

### Sync my clocks!

My clock microcontroller does not have an accurate timing. So it needs to be synced with some NTP. Since the servers are kept in sync by the hosting provider, this also works great:

    https://MyDomain/ipmon/showip.php?n=SlaveClock1&ret=json

And I also have the connectivity log :)
