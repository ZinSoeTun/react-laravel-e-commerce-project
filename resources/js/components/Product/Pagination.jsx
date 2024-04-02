import React from "react";

export default function Pagination({
    nPage,
    number,
    currentPage,
     nexPage,
    chaPage,
    prePage
}) {

    return (
        <div>
            {nPage > 1 && (
                <nav>
                    <ul className="pagination">
                        <li className="page-item">
                            <a
                                className="page-link"
                                style={{ cursor: "pointer" }}
                                onClick={prePage}
                            >
                                Previous
                            </a>
                        </li>
                        {number.map((n, i) => (
                            <li
                                className={`page-item ${
                                    currentPage === n ? "active" : ""
                                }`}
                                key={i}
                            >
                                <a
                                    className="page-link"
                                    style={{ cursor: "pointer" }}
                                    onClick={() => chaPage(n)}
                                >
                                    {n}
                                </a>
                            </li>
                        ))}
                        <li className="page-item">
                            <a
                                className="page-link"
                                style={{ cursor: "pointer" }}
                                onClick={nexPage}
                            >
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            )}
        </div>
    );
}
