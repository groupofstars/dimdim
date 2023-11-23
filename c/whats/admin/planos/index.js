const Facebook = require('facebook-node-sdk');

const fb = new Facebook({
  appId: '602207245222247',
  appSecret: '162b8d4c8ecaa310cf072bec764c6919',
  version: 'V12.0'
});

fb.api('/me/groups', function(res) {
  console.log(res);
});
