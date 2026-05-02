import Dropdown from "@/Components/Dropdown";
import { Link, usePage } from "@inertiajs/react";

export default function AuthenticatedLayout({ children }) {
    const user = usePage().props.auth.user;

    return (
        <div className="min-h-screen bg-white">
            <nav className="w-full flex flex-col gap-4 mb-6 border-b border-gray-50 bg-white">
                <div className="w-full flex items-center py-8 md:-mb-5 px-5 md:px-10">
                    {/* SISI KIRI: Burger & Brand */}
                    <div className="flex-1 flex items-center justify-between md:justify-start md:gap-9">
                        <div className="flex flex-col gap-1.5 w-6 cursor-pointer">
                            <span className="h-0.5 w-full bg-black"></span>
                            <span className="h-0.5 w-full bg-black"></span>
                            <span className="h-0.5 w-full bg-black"></span>
                        </div>

                        <Link href="/">
                            <h2 className="text-2xl md:text-3xl font-normal font-primary text-tertiary">
                                LibraFlow
                            </h2>
                        </Link>

                        {/* Mobile Profile (Hanya muncul di HP) */}
                        <div className="md:hidden">
                            <Dropdown>
                                <Dropdown.Trigger>
                                    <button className="focus:outline-none">
                                        <div className="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center border border-gray-200">
                                            <span className="text-[10px] font-bold text-gray-500 uppercase font-secondary">
                                                {user.name.substring(0, 1)}
                                            </span>
                                        </div>
                                    </button>
                                </Dropdown.Trigger>
                                <Dropdown.Content>
                                    <div className="px-4 py-2 border-b border-gray-100">
                                        <p className="text-xs font-bold text-tertiary font-secondary truncate">
                                            {user.name}
                                        </p>
                                    </div>
                                    <Dropdown.Link href={route("profile.edit")}>
                                        Profile
                                    </Dropdown.Link>
                                    <Dropdown.Link
                                        href={route("logout")}
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </Dropdown.Link>
                                </Dropdown.Content>
                            </Dropdown>
                        </div>
                    </div>

                    {/* TENGAH: Search Bar (Desktop) */}
                    <div className="hidden md:flex justify-center px-4 flex-1 max-w-[450px]">
                        <div className="relative w-full group">
                            <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="h-6 w-6 text-black"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={1.8}
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                            </div>
                            <input
                                type="text"
                                className="w-full h-14 bg-white border border-gray-200 rounded-none pl-12 pr-12 focus:outline-none focus:ring-0 focus:border-gray-300 transition-all font-secondary text-gray-500 placeholder-gray-300"
                                placeholder="Search for books.."
                            />
                            <div className="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="h-6 w-6 text-black"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={1.8}
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {/* SISI KANAN: User Profile (Desktop) */}
                    <div className="hidden md:flex flex-1 justify-end">
                        <Dropdown>
                            <Dropdown.Trigger>
                                <button className="focus:outline-none group">
                                    <div className="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center border-2 border-transparent group-hover:border-gray-200 transition-all">
                                        <span className="text-xs font-bold text-gray-500 uppercase font-secondary">
                                            {user.name.substring(0, 1)}
                                        </span>
                                    </div>
                                </button>
                            </Dropdown.Trigger>
                            <Dropdown.Content>
                                <div className="px-4 py-2 border-b border-gray-100">
                                    <p className="text-sm font-bold text-tertiary font-secondary">
                                        {user.name}
                                    </p>
                                </div>
                                <Dropdown.Link href={route("profile.edit")}>
                                    Profile
                                </Dropdown.Link>
                                <Dropdown.Link
                                    href={route("logout")}
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </Dropdown.Link>
                            </Dropdown.Content>
                        </Dropdown>
                    </div>
                </div>

                {/* Search Bar Mobile */}
                <div className="w-full px-4 md:hidden mb-4">
                    <div className="relative w-full">
                        <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-5 w-5 text-black"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>
                        <input
                            type="text"
                            className="w-full h-12 border border-gray-200 rounded-none pl-10 pr-10 focus:outline-none focus:ring-0 focus:border-gray-300 font-secondary text-gray-500"
                            placeholder="Search for books.."
                        />
                        <div className="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-5 w-5 text-black"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </nav>

            <main className="flex flex-col items-center">{children}</main>
        </div>
    );
}
