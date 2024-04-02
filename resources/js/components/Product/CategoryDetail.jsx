import React from 'react'

export default function CategoryDetail({category}) {

  return (
    <div>
     <p
                        className="text-primary fs-5 ms-3"
                        style={{ marginTop: "60px" }}
                    >
                        Product <span className="fs-3">{`>`}</span> Category
                        Detail <span className="fs-3">{`>`}</span>
                        <span className="text-info fs-5"> {category.name}</span>
                    </p>
                    <h1 className="text-primary text-center mb-3">
                        Products Detail
                    </h1>
                    <h3 className="text-primary text-center mb-5">Category</h3>
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
                            <h1 className="text-primary text-center">{category.name}</h1>
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
  )
}
