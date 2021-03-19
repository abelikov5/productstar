function doGet(e) {
    let pass = e.parameter.pass;
    let login = e.parameter.login;
    
    var app = SpreadsheetApp;
    var ss = app.openById('1v0KNEqiPG2KrNeozWXbnX7z-uiCMTuJxPIezRTFnUSs');        // таблица working_table
    var sheet = ss.getSheets()[0];                                                // первый лист
    
    var lastR = sheet.getLastRow();                                               // номер последней строки
    var arr_users = sheet.getRange('A1:K' + lastR).getValues();                   // забираем переменные из диапозона
    let i = 1;
  
    while (i < lastR) {
      if (arr_users[i][7] == login && arr_users[i][6] == pass) {
          return ContentService.createTextOutput('true||' + arr_users[i][0] + '||' + arr_users[i][1] + '||' + arr_users[i][2] 
                                                 + '||' + arr_users[i][3] + '||' + arr_users[i][4] + '||' + arr_users[i][5]
                                                 + '||' + arr_users[i][6] + '||' + arr_users[i][7] + '||' + arr_users[i][10]);
       }   
       i++;
    }
    return ContentService.createTextOutput('false');
  }