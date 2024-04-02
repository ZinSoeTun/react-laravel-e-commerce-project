import React from "react";

export default function BreadCrumb({ product }) {
    return (
        <div>
            <p className="text-primary fs-5 ms-3" style={{ marginTop: "60px" }}>
                Product <span className="fs-3">{`>`}</span> Product Detail{" "}
                <span className="fs-3">{`>`}</span>
                <span className="text-info fs-5"> {product.name}</span>
            </p>
        </div>
    );
}
