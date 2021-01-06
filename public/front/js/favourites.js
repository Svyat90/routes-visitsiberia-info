$(function () {
    let favouriteItems = $('.favourite-item');

    favouriteItems.each(function(i, d) {
        let id = $(this).attr("data-id");
        let type = $(this).attr("data-type");

        if (isFavourite(id, type)) {
            $(this).addClass('active');
        }
    });

    favouriteItems.click(function(e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let type = $(this).attr("data-type");

        if (toggleFavourite(id, type)) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
})

/**
 * @param type
 */
function getFavourites(type)
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
function updateFavourites(newArr, type)
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
function isFavourite(id, type)
{
    return getFavourites(type).includes(id);
}

/**
 * @param id
 * @param type
 */
function addToFavourites(id, type)
{
    let currentArr = getFavourites(type);
    currentArr.push(id);

    updateFavourites(currentArr, type);
}

/**
 * @param id
 * @param type
 */
function deleteFromFavourites(id, type)
{
    let currentArr = getFavourites(type);
    let newArr = remove(currentArr, id)

    updateFavourites(newArr, type)
}

/**
 * @param id
 * @param type
 */
function toggleFavourite(id, type)
{
    let favourite = isFavourite(id, type);

    if (favourite) {
        deleteFromFavourites(id, type);
        return false;
    }

    addToFavourites(id, type);
    return true;
}
