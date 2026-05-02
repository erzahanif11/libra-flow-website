import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { useState } from "react";
import PopularTab from "./Dashboard/Partials/PopularTab";
import ForYouTab from "./Dashboard/Partials/ForYouTab";
import BorrowedTab from "./Dashboard/Partials/BorrowedTab";
import WishlistTab from "./Dashboard/Partials/WishlistTab";

export default function Dashboard() {
    const [activeTab, setActiveTab] = useState("Popular");

    const tabs = ["Popular", "For You", "Borrowed", "Wishlist"];

    const renderTabContent = () => {
        switch (activeTab) {
            case "Popular":
                return <PopularTab />;
            case "For You":
                return <ForYouTab />;
            case "Borrowed":
                return <BorrowedTab />;
            case "Wishlist":
                return <WishlistTab />;
            default:
                return <PopularTab />;
        }
    };

    return (
        <AuthenticatedLayout>
            <Head title={activeTab} />

            <div className="w-full flex flex-col items-center">
                {/* Container Utama - max-w-5xl supaya segaris sama Navbar lo */}
                <div className="w-full max-w-5xl px-4 sm:px-6 lg:px-8 mt-4">
                    {/* TABS NAVIGATION */}
                    <div className="w-full border-b border-gray-100">
                        <div className="flex justify-center md:justify-start gap-8 overflow-x-auto no-scrollbar">
                            {tabs.map((tab) => (
                                <button
                                    key={tab}
                                    onClick={() => setActiveTab(tab)}
                                    className={`pb-4 text-sm md:text-base font-secondary transition-all relative whitespace-nowrap ${
                                        activeTab === tab
                                            ? "text-tertiary font-semibold"
                                            : "text-gray-400 hover:text-gray-600"
                                    }`}
                                >
                                    {tab}
                                    {activeTab === tab && (
                                        <div className="absolute bottom-0 left-0 w-full h-0.5 bg-tertiary" />
                                    )}
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* TABS CONTENT AREA */}
                    <div className="py-8">{renderTabContent()}</div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
