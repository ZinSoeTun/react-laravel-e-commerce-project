import React from "react";

export default function ProductDetailRelCategory({ category }) {
    return (
        <div>
            <h1
                className="text-success text-center mb-5"
                style={{ marginTop: "100px" }}
            >
                Related <h1 className="text-info"> Category</h1>
            </h1>
            <div className="d-lg-flex mb-5">
                <div className="w-100">
                    <img
                        src={`http://127.0.0.1:8000/storage/category/${category.image}`}
                        alt=""
                        width="100%"
                    />
                </div>
                <div
                    className="w-100  ms-lg-3 pt-4"
                    style={{ overflowX: "hidden" }}
                >
                    <h1 className="text-info text-center">{category.name}</h1>
                    <p
                        className="text-primary fs-5"
                        style={{
                            wordBreak: " break-word",
                            wordWrap: "break-word",
                            overflowX: "hidden",
                        }}
                    >
                        {category.description}
                    </p>
                </div>
            </div>
        </div>
    );
}
