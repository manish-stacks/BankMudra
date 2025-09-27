function openFullscreen() {
    var elem = document.documentElement;

    if (
        !document.fullscreenElement &&
        !document.mozFullScreenElement &&
        !document.webkitFullscreenElement &&
        !document.msFullscreenElement
    ) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
}

/*
|--------------------------------------------------------------------------
| Data Retrive through API
|--------------------------------------------------------------------------
*/

// Retrieve the site URL from the meta tag
const siteUrl = document
    .querySelector('meta[name="site-url"]')
    .getAttribute("content");

// Fetch categories and set them in the grid display
const fetchCategories = async () => {
    try {
        const response = await fetch(`${siteUrl}/api/category`);
        console.log("Fetched Categories:", response);
        const categories = await response.json();

        setCategories(categories);

        const sscCategory = categories.find(
            (category) => category.name.toLowerCase() === "ssc"
        );
        if (sscCategory) {
            fetchSubCategories(sscCategory.slug);
        }
    } catch (error) {
        console.warn(error.message || error);
    }
};

// Function to set categories in the grid display
const setCategories = (categories) => {
    const container = document.getElementById("itemsContainer");

    const itemsHTML = categories
        .map(
            (category) => `
        <div class="col-6 col-md-4 col-xl-3">
            <div class="popular-exam-home rounded-3 text-center p-3 position-relative btn-transition">
                <div class="icon-xl bg-body mx-auto rounded-circle mb-3">
                    <img class="category-link" data-slug="${category.slug}" src="${category.image_url}" alt="${category.name}" style="border-radius: 50px;">
                </div>
                <span class="mb-0 text-dark">
                    <a href="" class="category-link exam-title-link" data-slug="${category.slug}">${category.name}</a>
                </span>
            </div>
        </div>
    `
        )
        .join("");

    container.innerHTML = itemsHTML;
    setSlider(categories);

    // Define a base URL for categories
    const baseCategoryUrl = `${siteUrl}/category/`;
    // Add event listeners to category links
    document.querySelectorAll(".category-link").forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const slug = this.getAttribute("data-slug");
            const newUrl = baseCategoryUrl + slug;
            window.open(newUrl, "_blank");
        });
    });
};

// // Function to fetch subcategories using AJAX
// const fetchSubCategories = async (slug) => {
//     try {
//         console.log(`Fetching subcategories for slug: ${slug}`);
//         const response = await fetch(`${siteUrl}/api/subcategories/${slug}`);

//         if (!response.ok) {
//             const errorData = await response.text();
//             throw new Error("Category not found");
//         }
//         const subcategories = await response.json();
//         displaySubCategories(subcategories);
//     } catch (error) {
//         console.warn("Error fetching subcategories:", error.message || error);
//     }
// };

// // Function to display subcategories
// const displaySubCategories = (subcategories) => {
//     const subCategoryContainer = document.getElementById(
//         "subCategoryContainer"
//     );

//     const subItemsHTML = subcategories
//         .map(
//             (sub) => `
//         <div class="col-sm-6 col-md-4 col-lg-3">
//             <div class="bg-white rounded-3 p-3 position-relative btn-transition d-flex align-items-center shadow">
//                 <div class="icon-xl bg-body rounded-circle me-3" style="width: 80px; height: 80px; overflow: hidden;">
//                     <a href="${siteUrl}/papers/${sub.id}">
//                         <img src="${sub.image_url}" alt="${sub.name}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50px;">
//                     </a>
//                 </div>
//                 <div class="text-start" style="white-space: nowrap;">
//                     <h5 class="mb-0"><a href="${siteUrl}/papers/${sub.id}"" class="stretched-link">${sub.name}</a></h5>
//                     <span>100 Test Series</span>
//                 </div>
//             </div>
//         </div>
//     `
//         )
//         .join("");

//     subCategoryContainer.innerHTML = `<div class="row g-4">${subItemsHTML}</div>`;
// };

// // Function to set categories in the slider display
// const setSlider = (categories) => {
//     const sliderContainer = document.getElementById("sliderContainer");

//     const sliderHTML = `
//         <div class="tiny-slider arrow-round arrow-creative arrow-blur arrow-hover py-1">
//             <div class="tiny-slider-inner" data-autoplay="true" data-gutter="80" data-arrow="true" data-dots="false">
//                 ${categories
//                     .map(
//                         (category) => `
//                     <div class="my-2">
//                         <div class="bg-body text-center rounded-2 border py-2 px-1 position-relative">
//                             <img src="${category.image_url}" class="h-40px" alt="${category.name}">
//                             <a href="#" class="text-primary-hover stretched-link slider-category-link" data-slug="${category.slug}">
//                                 <span class="h6 ms-2">${category.name}</span>
//                             </a>
//                         </div>
//                     </div>
//                 `
//                     )
//                     .join("")}
//             </div>
//         </div>`;

//     sliderContainer.innerHTML = sliderHTML;

//     tns({
//         container: sliderContainer.querySelector(".tiny-slider-inner"),
//         items: 5,
//         slideBy: "page",
//         autoplay: true,
//         autoplayButtonOutput: false,
//         controls: true,
//         nav: true,
//         gutter: 80,
//         responsive: {
//             640: { items: 2 },
//             768: { items: 3 },
//             1200: { items: 5 },
//         },
//     });

//     // Fetch test series data and populate the slider
//     fetch(`${siteUrl}/api/test-series`)
//         .then((res) => {
//             if (!res.ok) {
//                 throw new Error("Network response was not ok");
//             }
//             return res.json();
//         })
//         .then((data) => {
//             const papersSliderContainer =
//                 document.getElementById("papers-slider");
//             papersSliderContainer.innerHTML = "";

//             data.forEach((paper) => {
//                 papersSliderContainer.insertAdjacentHTML(
//                     "beforeend",
//                     `
//                     <div class="card-container">
//                         <div class="card border bg-transparent p-2 h-100" style="margin: 0 10px;">
//                             <div class="rounded-top overflow-hidden">
//                                 <div class="card-overlay-hover position-relative">
//                                     <a href="${siteUrl}/papers/${paper.id}
//                    ">
//                     <img src="${siteUrl}/${
//                         paper.thumb
//                     }" class="card-img-top" alt="course image" style="object-fit: cover;">
//                 </a>

//                                     <span class="badge position-absolute top-0 start-0 m-2">
//                                         ${
//                                             paper.ispaid === 2
//                                                 ? `<span class="badge bg-info fs-6 p-1">₹ ${paper.cost}</span>`
//                                                 : paper.ispaid === 1
//                                                 ? `<span class="badge bg-success fs-6 p-1">Free</span>`
//                                                 : ""
//                                         }
//                                     </span>
//                                 </div>
//                             </div>
//                             <div class="card-body">
//                                  <a href="${siteUrl}/papers/${
//                         paper.id
//                     }" class="text-decoration-none">
//                         <h5 class="card-title">${paper.name}</h5>
//                     </a>
//                                 <div class="d-sm-flex justify-content-between align-items-center">
//                                     <div>
//                                         <small>Questions: ${
//                                             paper.totalNoQuestion || 0
//                                         } | Duration: ${
//                         paper.duration || "N/A"
//                     }</small>
//                                     </div>
//                                 </div>
//                                 <a href="#" class="btn btn-link p-0 mb-0">View detail<i class="bi bi-arrow-right ms-2"></i></a>
//                             </div>
//                         </div>
//                     </div>
//                 `
//                 );
//             });

//             tns({
//                 container: ".tiny-slider-inners",
//                 items: 4,
//                 slideBy: "page",
//                 autoplay: false,
//                 nav: false,
//             });
//         })
//         .catch((error) => console.error("Error:", error));

//     // Add event listeners to slider category links
//     document.querySelectorAll(".slider-category-link").forEach((link) => {
//         link.addEventListener("click", function (event) {
//             event.preventDefault(); // Prevent the default link behavior
//             const slug = this.getAttribute("data-slug");
//             fetchSubCategories(slug); // Fetch subcategories
//         });
//     });
// };

// // Function to get the slug from the URL
// const getSlugFromURL = () => {
//     const pathParts = window.location.pathname.split("/");
//     return pathParts.pop();
// };

// // Fetch subcategories using the slug
// const fetchSubCategoriesBySlug = async (slug) => {
//     try {
//         const response = await fetch(`${siteUrl}/api/subcategories/${slug}`);
//         if (!response.ok) throw new Error("Network response was not ok");
//         return await response.json();
//     } catch (error) {
//         console.error("Error fetching subcategories:", error);
//         return [];
//     }
// };

// // Main function to initialize the page
// const initPage = async () => {
//     fetchCategories(); // Fetch categories
//     const subcategories = await fetchSubCategoriesBySlug(getSlugFromURL());
//     displayFetchedSubCategories(subcategories);
// };

// // Immediately invoke the initPage function
// (async () => await initPage())();

// // Function to fetch subcategories
// const fetchSubCategories = async (slug) => {
//     try {
//         const response = await fetch(`${siteUrl}/api/subcategories/${slug}`);
//         if (!response.ok) throw new Error("Category not found");
//         const subcategories = await response.json();
//         displaySubCategories(subcategories);
//     } catch (error) {
//         console.warn("Error fetching subcategories:", error.message || error);
//     }
// };

// // Function to display subcategories
// const displaySubCategories = async (subcategories) => {
//     const subCategoryContainer = document.getElementById(
//         "subCategoryContainer"
//     );

//     const subItemsHTML = subcategories
//         .map(
//             (sub) => `
//         <div class="col-sm-6 col-md-4 col-lg-3">
//             <div class="bg-white rounded-3 p-3 position-relative btn-transition d-flex align-items-center shadow">
//                 <div class="icon-xl bg-body rounded-circle me-3" style="width: 80px; height: 80px; overflow: hidden;">
//                     <a href="${siteUrl}/papers/${sub.slug}">
//                         <img src="${sub.image_url}" alt="${sub.name}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50px;">
//                     </a>
//                 </div>
//                 <div class="text-start" style="white-space: nowrap;">
//                     <h5 class="mb-0"><a href="${siteUrl}/papers/${sub.slug}" class="stretched-link">${sub.name}</a></h5>
//                     <span>100 Test Series</span>
//                 </div>
//             </div>
//         </div>`
//         )
//         .join("");

//     subCategoryContainer.innerHTML = `<div class="row g-4">${subItemsHTML}</div>`;
// };

const fetchSubCategories = async (slug) => {
    try {
        const response = await fetch(`${siteUrl}/api/subcategories/${slug}`);
        if (!response.ok) throw new Error("Category not found");

        const subcategories = await response.json();
        displaySubCategories(subcategories);
    } catch (error) {
        console.warn("Error fetching subcategories:", error.message || error);
    }
};

const displaySubCategories = (subcategories) => {
    const subCategoryContainer = document.getElementById(
        "subCategoryContainer"
    );

    // Check if there are subcategories to display
    if (!subcategories.length) {
        subCategoryContainer.innerHTML = `<p>No subcategories found.</p>`;
        return;
    }

    const subItemsHTML = subcategories
        .map(
            (sub) => `
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="bg-white rounded-3 p-3 position-relative btn-transition d-flex align-items-center shadow">
                <div class="icon-xl bg-body rounded-circle me-3" style="width: 80px; height: 80px; overflow: hidden;">
                    <a href="">
                        <img src="${sub.image_url}" alt="${sub.name}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50px;">
                    </a>
                </div>
                <div class="text-start" style="white-space: nowrap;">
                    <h5 class="mb-0"><a href="" class="stretched-link">${sub.name}</a></h5>
                    <span>100 Test Series</span>
                </div>
            </div>
        </div>
    `
        )
        .join("");

    subCategoryContainer.innerHTML = `<div class="row g-4">${subItemsHTML}</div>`;
};

// Function to set categories in the slider display
const setSlider = async (categories) => {
    const sliderContainer = document.getElementById("sliderContainer");

    const sliderHTML = `
        <div class="tiny-slider arrow-round arrow-creative arrow-blur arrow-hover py-1">
            <div class="tiny-slider-inner" data-autoplay="true" data-gutter="80" data-arrow="true" data-dots="false">
                ${categories
                    .map(
                        (category) => `
                    <div class="my-2">
                        <div class="bg-body text-center rounded-2 border py-2 px-1 position-relative">
                            <img src="${category.image_url}" class="h-40px" alt="${category.name}">
                            <a href="#" class="text-primary-hover stretched-link slider-category-link" data-slug="${category.slug}">
                                <span class="h6 ms-2">${category.name}</span>
                            </a>
                        </div>
                    </div>`
                    )
                    .join("")}
            </div>
        </div>`;

    sliderContainer.innerHTML = sliderHTML;

    tns({
        container: sliderContainer.querySelector(".tiny-slider-inner"),
        items: 5,
        slideBy: "page",
        autoplay: true,
        autoplayButtonOutput: false,
        controls: true,
        nav: true,
        gutter: 80,
        responsive: {
            640: { items: 2 },
            768: { items: 3 },
            1200: { items: 5 },
        },
    });

    const fetchSlider = async () => {
        try {
            const res = await fetch(`${siteUrl}/api/test-series-slider`);
            if (!res.ok) throw new Error("Network response was not ok");

            const data = await res.json(); // data will now be HTML snippets
            displaySliderPapers(data);
        } catch (error) {
            console.error("Error:", error);
        }
    };

    const displaySliderPapers = (renderedPapers, page = 1) => {
        const container = document.getElementById("papers-slider");
        if (page === 1) container.innerHTML = ""; // Clear container for new data

        if (!renderedPapers.length)
            return (container.innerHTML = "<p>No papers available.</p>");

        // Insert the rendered HTML for each paper directly into the container
        renderedPapers.forEach((paperHtml) => {
            container.insertAdjacentHTML("beforeend", paperHtml);
        });

        // Reinitialize the Tiny Slider after adding the cards
        tns({
            container: ".tiny-slider-inners",
            items: 4,
            slideBy: "page",
            autoplay: false,
            nav: false,
        });
    };

    // Call the fetchSlider function to load the papers
    fetchSlider();

    // Add event listeners to slider category links
    document.querySelectorAll(".slider-category-link").forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default link behavior
            const slug = this.getAttribute("data-slug");
            fetchSubCategories(slug); // Fetch subcategories
        });
    });
};

// Function to get the slug from the URL
const getSlugFromURL = () => {
    const pathParts = window.location.pathname.split("/");
    // console.log(pathParts);
    return pathParts.pop();
};

// Fetch subcategories using the slug
const fetchSubCategoriesBySlug = async (slug) => {
    try {
        const response = await fetch(`${siteUrl}/api/subcategories/${slug}`);
        if (!response.ok) throw new Error("Network response was not ok");
        return await response.json();
    } catch (error) {
        console.error("Error fetching subcategories:", error);
        return [];
    }
};

// Main function to initialize the page
const initPage = async () => {
    await fetchCategories(); // Fetch categories
    const subcategories = await fetchSubCategoriesBySlug(getSlugFromURL());
    displayFetchedSubCategories(subcategories);
};

// Immediately invoke the initPage function
(async () => await initPage())();

/*
|--------------------------------------------------------------------------
| Test Series Code Start
|--------------------------------------------------------------------------
|
*/

let page = 1,
    hasMorePages = true;

// Function to get the slug from the URL

const fetchTestSeries = async (page = 1, search = "") => {
    const loader = document.getElementById("loader");
    const showMoreButton = document.getElementById("showMoreButton");
    const container = document.getElementById("papers-container");

    // Get the slug from the URL
    const slug = getSlugFromURL();
    console.log("Slug Retrive:", slug);

    try {
        // Show loader
        if (loader) {
            loader.style.display = "block";
        }

        // Use the slug in the fetch URL
        const res = await fetch(
            `${siteUrl}/api/test-series/${slug}?page=${page}&search=${search}`
        );

        console.log("Fetching from:", res);
        console.log(
            "Fetching from:",
            `${siteUrl}/api/test-series/${slug}?page=${page}&search=${search}`
        );

        const { data, next_page_url } = await res.json();

        // Check if there are more pages
        hasMorePages = !!next_page_url; // Change this to the outer scope variable
        displayPapers(data, page); // Pass the array of HTML strings

        // Show or hide the "Show More" button based on pagination
        if (showMoreButton) {
            showMoreButton.style.display = hasMorePages ? "block" : "none";
        }
    } catch (err) {
        console.error("Error fetching papers:", err);
        if (container) {
            container.innerHTML =
                "<p>Error fetching papers. Please try again.</p>";
        }
    } finally {
        // Hide loader
        if (loader) {
            loader.style.display = "none";
        }
    }
};

const displayPapers = (papersHtml, page = 1) => {
    const container = document.getElementById("papers-container");
    if (page === 1) container.innerHTML = ""; // Clear container for new data

    if (!papersHtml.length) {
        return (container.innerHTML = "<p>No papers available.</p>");
    }

    // Insert the HTML for each product card
    papersHtml.forEach((paperHtml) => {
        container.insertAdjacentHTML("beforeend", paperHtml);
    });
};

// Handle search input
document
    .getElementById("searchBox")
    .addEventListener("input", async (event) => {
        const searchTerm = event.target.value;
        page = 1;
        hasMorePages = true;
        const showMoreButton = document.getElementById("showMoreButton");
        if (showMoreButton) {
            showMoreButton.style.display = "none";
        }

        if (searchTerm) {
            await fetchTestSeries(page, searchTerm); // Fetch with search term
        } else {
            await fetchTestSeries(); // Fetch all papers if search term is empty
        }
    });

// Fetch test series on initial load
fetchTestSeries();

document
    .getElementById("showMoreButton")
    .addEventListener("click", async () => {
        if (hasMorePages) {
            page++;
            const searchTerm = document.getElementById("searchBox").value;
            await fetchTestSeries(page, searchTerm);
        }
    });

// Filter test papers based on subcategory selection
const filterPapers = async () => {
    const selectedCategories = [
        ...document.querySelectorAll(".sub-category-checkbox:checked"),
    ].map((el) => el.value);

    const showMoreButton = document.getElementById("showMoreButton");

    if (!selectedCategories.length) {
        page = 1;
        hasMorePages = true;
        if (showMoreButton) {
            showMoreButton.style.display = "block";
        }
        await fetchTestSeries();
        return;
    }

    if (showMoreButton) {
        showMoreButton.style.display = "none";
    }

    try {
        const res = await fetch(`${siteUrl}/api/category-wise-series`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ category_ids: selectedCategories }),
        });

        if (!res.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await res.json();
        displayPapers(data);
    } catch (err) {
        console.error("Error fetching filtered papers:", err);
    }
};

const handleFilterChange = async () => {
    const selectedCategories = [
        ...document.querySelectorAll(".sub-category-checkbox:checked"),
    ].map((el) => el.value);

    // Get selected payment types (checkboxes)
    const selectedPaymentTypes = [
        ...document.querySelectorAll(".filter-checkbox:checked"),
    ].map((el) => el.value);

    const showMoreButton = document.getElementById("showMoreButton");

    if (!selectedCategories.length && selectedPaymentTypes.length === 0) {
        page = 1;
        hasMorePages = true;
        if (showMoreButton) {
            showMoreButton.style.display = "block";
        }
        await fetchTestSeries(); // Fetch all papers if no filters
        return;
    }

    if (showMoreButton) {
        showMoreButton.style.display = "none";
    }

    try {
        const res = await fetch(`${siteUrl}/api/category-wise-series`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                category_ids: selectedCategories,
                paymentType: selectedPaymentTypes, // Send selected payment types as an array
            }),
        });

        if (!res.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await res.json();
        displayPapers(data);
    } catch (err) {
        console.error("Error fetching filtered papers:", err);
    }
};

// Add event listeners to filter checkboxes
document.querySelectorAll(".filter-checkbox").forEach((checkbox) => {
    checkbox.addEventListener("change", handleFilterChange);
});

// Existing event listener for subcategory checkboxes
document.querySelectorAll(".sub-category-checkbox").forEach((checkbox) => {
    checkbox.addEventListener("change", handleFilterChange);
});

// Function to display fetched subcategories
const displayFetchedSubCategories = async (subcategories) => {
    const listContainer = document.getElementById("subcategoryList");
    listContainer.innerHTML = subcategories
        .map(
            ({ name, id }) => `
        <li class="mb-2">
            <label class="d-flex align-items-center">
                <input type="checkbox" class="form-check-input me-2 sub-category-checkbox" value="${id}">
                <a href="#" class="text-decoration-none sub-category-link text-dark"><strong>${name}</strong></a>
            </label>
        </li>
    `
        )
        .join("");

    document
        .querySelectorAll(".sub-category-checkbox")
        .forEach((checkbox) => (checkbox.onchange = filterPapers));
};

// Immediately invokes
(async () => {
    await init();
})();

/*
|--------------------------------------------------------------------------
| Test Series Code End
|--------------------------------------------------------------------------
|
*/
