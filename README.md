![docker build automated](https://img.shields.io/docker/cloud/automated/dotriver/grafana-matrix-bot)
![docker build status](https://img.shields.io/docker/cloud/build/dotriver/grafana-matrix-bot)
![docker build status](https://img.shields.io/docker/pulls/dotriver/grafana-matrix-bot)

# Simple Bot for Matrix on Alpine Linux + S6 Overlay

It send a message when a grafana alert is triggered (you have to configure grafana to request the bot on alert with the `ACCESS_TOKEN`).

it can be manualy triggerd via `curl -X POST [...]`.

# Auto configuration parameters :

- BOT_TOKEN=TOKEN          ( token for bot identification : Matrix Token )
- ROOM_ID=%21ROOMID        ( Synapse room ID without the `!` \[%21=!\])
- SYNAPSE_SERVER=SERVER    ( Synapse server )
- ACCESS_TOKEN=TOKEN       ( token for request authentification )

# grafana alert message

```
{
  "dashboardId":1,
  "evalMatches":[
    {
      "value":1,
      "metric":"Count",
      "tags":{}
    }
  ],
  "imageUrl":"https://grafana.com/assets/img/blog/mixed_styles.png",
  "message":"Notification Message",
  "orgId":1,
  "panelId":2,
  "ruleId":1,
  "ruleName":"Panel Title alert",
  "ruleUrl":"http://grafana.test.example/d/hZ7BuVbWz/test-dashboard?fullscreen\u0026edit\u0026tab=alert\u0026panelId=2\u0026orgId=1",
  "state":"alerting",
  "tags":{
    "tag name":"tag value"
  },
  "title":"[Alerting] Panel Title alert"
}
```

# Compose file exemple

```
version: '3.1'

services:

  matrixapi-bot:
    build: .
    environment:
      - BOT_TOKEN=s6g4bdfvb45df5b424dfv4hg68gtnbf6
      - ROOM_ID=%21nhdyozVCse8
      - SYNAPSE_SERVER=https://synapse.test.example
      - ACCESS_TOKEN="MySuperTokenForRequestAuthentification"
    ports:
      - 8088:80

```
