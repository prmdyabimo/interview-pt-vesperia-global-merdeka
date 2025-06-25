import React, { useState, Suspense } from "react";
import Navigation from "./presentation/components/Navigation";
import "./App.css";

const DetailKejadianResikoPage = React.lazy(() =>
  import("./presentation/pages/DetailKejadianResikoPage")
);
const DetailKerugianPage = React.lazy(() =>
  import("./presentation/pages/DetailKerugianPage")
);
const ListDataPage = React.lazy(() =>
  import("./presentation/pages/ListDataPage")
);

const LoadingSpinner = () => (
  <div className="loading-container">
    <div className="loading-spinner">
      <div className="spinner"></div>
      <p>Loading...</p>
    </div>
  </div>
);

function App() {
  const [currentPage, setCurrentPage] = useState("kejadian");

  const renderCurrentPage = () => {
    switch (currentPage) {
      case "kejadian":
        return <DetailKejadianResikoPage />;
      case "kerugian":
        return <DetailKerugianPage />;
      case "list_data":
        return <ListDataPage />;
      default:
        return <DetailKejadianResikoPage />;
    }
  };

  return (
    <div className="App">
      <Navigation currentPage={currentPage} onPageChange={setCurrentPage} />

      <Suspense fallback={<LoadingSpinner />}>{renderCurrentPage()}</Suspense>
    </div>
  );
}

export default App;
