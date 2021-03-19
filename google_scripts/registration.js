function doGet(e) {
    let fio         = decodeURIComponent(e.parameter.fio);
    let email       = decodeURIComponent(e.parameter.email);  
    let phone       = e.parameter.phone  
    let city        = decodeURIComponent(e.parameter.city); 
    let region      = decodeURIComponent(e.parameter.region);
    let country     = decodeURIComponent(e.parameter.country);
    let job         = decodeURIComponent(e.parameter.job);
    let post        = decodeURIComponent(e.parameter.post);
    let name        = decodeURIComponent(e.parameter.name);
    let lastname    = decodeURIComponent(e.parameter.lastname);
    let posis       = decodeURIComponent(e.parameter.posis);
    
    var app   = SpreadsheetApp;
    var ss    = app.openById('1v0KNEqiPG2KrNeozWXbnX7z-uiCMTuJxPIezRTFnUSs');        // таблица working_table
    var sheet = ss.getSheets()[0];                                                // первый лист
    var lastR = sheet.getLastRow();                                               // номер последней строки
    
  //  return ContentService.createTextOutput('user_id = ' + id);
    
    let arr_logins = sheet.getRange('H3:H' + lastR).getValues();                   // забираем переменные из диапозона
    let i = 0;
    while (i < lastR - 1) {
      if (arr_logins[i] == email) {
          return ContentService.createTextOutput('exist');
       }   
       i++;
    }
    
  //  GmailApp.sendEmail(email, 'Доступы к порталу doctor.school', 
  //                     `Вы успешно зарегистрировались на портале doctor.school!
  //Для доступа учебным материалам используйте следующие регистрационные данные:
  //Телефон: +` + phone + `
  //Email: ` + email);
   
    sheet.getRange(lastR + 1, 1).setValue(fio);
    sheet.getRange(lastR + 1, 2).setValue(job);
    sheet.getRange(lastR + 1, 3).setValue(region);
    sheet.getRange(lastR + 1, 4).setValue(city);
    sheet.getRange(lastR + 1, 5).setValue(post);
    sheet.getRange(lastR + 1, 6).setValue(posis);
    sheet.getRange(lastR + 1, 7).setValue(phone);
    sheet.getRange(lastR + 1, 8).setValue(email);
    sheet.getRange(lastR + 1, 9).setValue(name);
    sheet.getRange(lastR + 1, 10).setValue(lastname);
    // прописываем id
    let id = parseInt(sheet.getRange(2, 12).getValue());
    id += 1;
    id = id.toString();
    if(id.length <= 4) {
      id = '0' + id;
    }
    sheet.getRange(2, 12).setValue(id);
    sheet.getRange(lastR + 1, 11).setValue(id);
    
    return ContentService.createTextOutput('true');
  }