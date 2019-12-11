function resetStudentSearchQuery() {
    var queryDict = {};
    var fieldNameDict = {};
    var fieldIndex = 0;
    location.search.substr(1).split("&").forEach(function(item) {fieldNameDict[fieldIndex++] = item.split("=")[0]; queryDict[item.split("=")[0]] = decodeURIComponent(item.split("=")[1])});
    if ('true' === queryDict['search_submit']) {
        var searchForm = document.forms['student_search'];
        for (var i = 0; i < fieldIndex; ++i) {
            searchForm[fieldNameDict[i]].value = queryDict[fieldNameDict[i]];
        }
        searchForm['student_name'].value = searchForm['student_name'].value.replace(/\+/g," ");
    }
}

function resetActivitySearchQuery() {
    var queryDict = {};
    var fieldNameDict = {};
    var fieldIndex = 0;
    location.search.substr(1).split("&").forEach(function(item) {fieldNameDict[fieldIndex++] = item.split("=")[0]; queryDict[item.split("=")[0]] = decodeURIComponent(item.split("=")[1])});
    if ('true' === queryDict['search_submit']) {
        var searchForm = document.forms['activity_search'];
        for (var i = 0; i < fieldIndex; ++i) {
            searchForm[fieldNameDict[i]].value = queryDict[fieldNameDict[i]];
        }
        searchForm['teacher_name'].value = searchForm['teacher_name'].value.replace(/\+/g," ");
        searchForm['activity_name'].value = searchForm['activity_name'].value.replace(/\+/g," ");
    }
}