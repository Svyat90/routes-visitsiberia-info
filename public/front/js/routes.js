$(function () {
    let routeAddItems = $('.route-item-add');
    let routeAddedItems = $('.route-item-added');

    routeAddItems.each(function(i, d) {
        let element = $(this);
        let id = element.attr("data-id");
        let type = element.attr("data-type");

        if (isAdded(id, type)) {
            showData(element, 'route-item-added')
        }
    });

    routeAddItems.click(function(e) {
        e.preventDefault();

        let element = $(this);
        let id = element.attr("data-id");
        let type = element.attr("data-type");

        addToList(id, type);
        showData(element, 'route-item-added')
    });

    routeAddedItems.click(function(e) {
        e.preventDefault();

        let element = $(this);
        let id = element.attr("data-id");
        let type = element.attr("data-type");

        deleteFromList(id, type);
        hideData(element, 'route-item-add');
    });

    $(document).on('click', '.route-item-add-ajax', function() {
        let element = $(this);
        let id = element.attr("data-id");
        let type = element.attr("data-type");

        addToList(id, type);
        showData(element, 'route-item-added-ajax')
    });

    $(document).on('click', '.route-item-added-ajax', function() {
        let element = $(this);
        let id = element.attr("data-id");
        let type = element.attr("data-type");

        deleteFromList(id, type);
        hideData(element, 'route-item-add-ajax');
    });
})

/**
 * @param element
 * @param classAdded
 */
function showData(element, classAdded)
{
    element.hide();
    element.parent().find('.' + classAdded).removeClass('d-none');
    element.parent().parent().find('.route-item-go').removeClass('d-none');
    // element.parent().parent().find('button.favourite-item').hide();
}

/**
 *
 * @param element
 * @param classAdd
 */
function hideData(element, classAdd)
{
    element.addClass('d-none');
    element.parent().parent().find('.route-item-go').addClass('d-none');
    element.parent().find('.' + classAdd).show();
    element.parent().find('.' + classAdd).removeClass('d-none');
    // element.parent().parent().find('button.favourite-item').show();
}

/**
 * @param type
 */
function getListToRoute(type)
{
    let currentArr = localStorage.getObj(type);

    if (currentArr === null) {
        return [];
    }

    return currentArr;
}

/**
 * @param newArr
 * @param type
 */
function updateList(newArr, type)
{
    let uniqueValues = newArr.filter(onlyUnique);

    localStorage.setObj(type, uniqueValues);

    setCookie(type, uniqueValues, 366)
}

/**
 * @param id
 * @param type
 * @returns boolean
 */
function isAdded(id, type)
{
    return getListToRoute(type).includes(id);
}

/**
 * @param id
 * @param type
 */
function addToList(id, type)
{
    let currentArr = getListToRoute(type);
    currentArr.push(id);

    updateList(currentArr, type);
}

/**
 * @param id
 * @param type
 */
function deleteFromList(id, type)
{
    let currentArr = getListToRoute(type);
    let newArr = remove(currentArr, id)

    updateList(newArr, type)
}
